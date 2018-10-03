<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BootstrapTableResource extends ResourceCollection
{
    private $itemResource;


    public function __construct($resource, $itemResource)
    {
        $this->itemResource = $itemResource;
        $this->resource = $resource;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $query = $this->resource;

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

        $total = $query->pluck('id')->count();
        $results = $query->orderBy($sort, $order)
            ->offset($offset)
            ->limit($limit)
            ->get();

        $rows = $this->itemResource::collection($results);

        return [
            'rows'  => $rows,
            'total' => $total
        ];
    }
}
