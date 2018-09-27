<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.01.2018
 * Time: 15:31
 */

namespace App\Helpers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BootstrapTableHelper
{
    public static function wrapResults($total, $results)
    {
        return ['total' => $total, 'rows' => $results];
    }

    public static function processTableRequest(Request $request, Builder $query, $searchFields)
    {
        $search = $request->input('search', null);
        $filter = $request->input('filter', []);
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        foreach ($filter as $filterTuple) {
            $column = $filterTuple[0];
            $operator = $filterTuple[1];
            if (!isset($filterTuple[2]))
                continue;
            $value = $filterTuple[2];
            if ($operator == 'between') {
                if (count($value) == 2)
                    $query = $query->whereBetween($column, $value);
            } elseif ($operator == 'in') {
                if (count($value) > 0)
                    $query = $query->whereIn($column, $value);
            } else
                $query = $query->where($column, $operator, $value);

        }
        if ($search !== null) {
            $query = SearchHelper::searchByFields($query, $searchFields, $search);

//            $query = $query->where(function (Builder $query) use ($search, $searchFields, $customFields) {
//                if($searchFields){
//                    foreach ($searchFields as $index => $searchField) {
//
//                        if (!is_numeric($index))
//                            foreach ($searchField as $relSearchField) {
//                                $query = $query->orWhereHas($index, function (Builder $q) use ($relSearchField, $search) {
//                                    $q->where($relSearchField, 'like', "%$search%");
//                                });
//                            }
//                        else
//                            $query = $query->orWhere($searchField, 'like', "%$search%");
//
//                    }
//                }
//            });
        }
        $total = $query->pluck('id')->count();
        $results = $query->orderBy($sort, $order)
            ->offset($offset)
            ->limit($limit)
            ->get();


        $response = self::wrapResults($total, $results);
        return $response;
    }
}