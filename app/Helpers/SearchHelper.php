<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.09.2017
 * Time: 12:26
 */

namespace App\Helpers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchHelper
{
    public static function processDataTableRequest(Request $request, Builder $query, $searchFields)
    {
        $recordsTotal = $query->count();
        $filteredQuery = self::filterData($request, $query, $searchFields);
        $response = self::wrapData($request, $filteredQuery, $recordsTotal);
        return $response;
    }

    private static function filterData(Request $request, Builder $data, $searchFields)
    {
        $search = $request->input('search.value', null);
        $columns = $request->input('columns', []);

        foreach ($columns as $index => $column) {
            if (isset($column['search']) && isset($column['search']['value']) && $column['search']['value'] != 'null') {
                $parts = explode('.', $column['data']);
                if ($column['search']['regex'] == 'true') {
                    $data = $data->where($parts[0], $column['search']['value']);
                } else if (count($parts) == 1) {
                    $data = $data->where($parts[0], 'like', '%' . $column['search']['value'] . '%');
                } else if (count($parts) == 2) {
                    $data = self::searchByFields($data, [$parts[0] => [$parts[1]]], $column['search']['value']);
                }
            }
        }
        if ($search !== null) {

            $data = self::searchByFields($data, $searchFields, $search);
        }

        return $data;
    }

    public static function searchByFields(Builder $query, $fields, $search)
    {
        foreach (explode(' ', $search) as $word) {
            $word = trim($word);
            if ($word != '') {
                $query->where(function ($mainQuery) use ($fields, $word) {
                    foreach ($fields as $index => $field) {
                        if (!is_array($field))
                            $mainQuery->orWhere($field, 'like', '%' . $word . '%');
                        else {
                            foreach ($field as $relField) {
                                $mainQuery->orWhereHas($index, function ($q) use ($relField, $word) {
                                    $q->where($relField, 'like', '%' . $word . '%');
                                });
                            }
                        }
                    }
                });
            }

        }
        return $query;
    }

    private static function wrapData(Request $request, $data, $recordsTotal)
    {
        $sort = $request->input('sort', 'id');
        $draw = $request->input('draw', 'id');

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $columns = $request->input('columns', []);
        $orders = $request->input('order', []);

        foreach ($orders as $index => $order) {
            $orderData = $columns[$order['column']]['name'] ?? $columns[$order['column']]['data'];
            if (is_array($orderData))
                foreach ($orderData as $orderDatum) {
                    $data = $data->orderBy($orderDatum, $order['dir']);
                }
            else
                $data = $data->orderBy($orderData, $order['dir']);
        }
        return [
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $data->count(),
            'data'            => $data->offset($start)
                ->limit($length)
                ->get()];
    }

    public static function applyFilters($query, $filters)
    {

    }

    public static function applyFilter(Builder $query, $column, $method, $value = null)
    {
        if (func_num_args() == 3) {
            $value = $method;
            $method = '=';
        }
        switch ($method) {
            case 'between':
                $orders = $query->whereBetween($column, $value);
                break;
            case 'in':
                $orders = $query->whereIn($column, $value);
                break;
            case 'not in':
                $orders = $query->whereNotIn($column, $value);
                break;
            default:
                $orders = $query->where($column, $method, $value);
                break;
        }
        return $query;
    }
}