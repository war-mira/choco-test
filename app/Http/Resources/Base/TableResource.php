<?php

namespace App\Http\Resources\Base;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Resources\Json\Resource;

class TableResource extends Resource
{
    /**
     * @var static Resource
     */
    protected $rowResource;

    /**
     * @var Builder
     */
    protected $baseQuery;


    public function __construct($resource, $rowResource = null)
    {
        $this->baseQuery = $resource;
        $this->rowResource = $rowResource ?? $this->rowResource;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $query = $this->getBaseQuery($request);
        $tableData = $this->getData($query, $request);
        return $tableData;
    }

    protected function getBaseQuery($request)
    {
        return $this->baseQuery;
    }

    protected function getData($query, $request)
    {
        $query = $this->processQueryRequest($query, $request);

        $total = $query->count();

        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $sort = $request->input('sort','id');
        $order = $request->input('order','desc');

        $items = $query
            ->offset($offset)
            ->limit($limit)
            ->orderBy($sort,$order)
            ->get();

        $rows = $this->wrapItemsToRows($items, $request);
        return compact('total', 'rows');
    }

    protected function processQueryRequest($query, $request)
    {
        $filters = $request->input('filter', []);
        $query = $this::processQueryFilters($query, $filters);

        $search = $request->input('search', '');
        $query = $this::processQuerySearch($query, $search);
        return $query;
    }

    protected function processQuerySearch($query, $search)
    {
        return $query;
    }

    protected function processQueryFilters($query, $filters)
    {

        foreach ($filters as $filter) {
            $query->where(function ($query) use ($filter) {

                if (isset($filter['relation'])) {
                    $relFilter = array_except($filter, 'relation');
                    $query->whereHas($filter['relation'], function ($relQuery) use ($relFilter) {
                        self::processQueryFilters($relQuery, [$relFilter]);
                    });
                } else {
                    $columns = is_array($filter['column']) ? $filter['column'] : [$filter['column']];
                    $prefix = 'where';
                    for ($i = 0; $i < count($columns); $i++) {
                        $column = $columns[$i];
                        if ($filter['operator'] == 'in') {
                            $val = is_array($filter['value'] ?? false) ? $filter['value'] : [$filter['value'] ?? null];
                            $query->{$prefix . 'In'}($column, $val);
                        } elseif ($filter['operator'] == 'not in') {
                            $val = is_array($filter['value'] ?? false) ? $filter['value'] : [$filter['value'] ?? null];
                            $query->{$prefix . 'NotIn'}($column, $val);
                        } elseif ($filter['operator'] == 'between') {
                            $query->{$prefix . 'Between'}($column, $filter['value']);
                        } elseif ($filter['operator'] == 'not between') {
                            $query->{$prefix . 'NotBetween'}($column, $filter['value']);
                        } elseif ($filter['operator'] == 'like') {
                            $query->{$prefix}($column, $filter['operator'], '%' . $filter['value'] . '%');
                        } else {
                            $query->{$prefix}($column, $filter['operator'], $filter['value']);
                        }
                        $prefix = 'orWhere';
                    }

                }
            });

        }
        return $query;
    }

    protected function wrapItemsToRows($items, $request)
    {
        return $this->rowResource::collection($items)->toArray($request);
    }
}
