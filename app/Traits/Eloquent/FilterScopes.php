<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.11.2017
 * Time: 11:29
 */

namespace App\Traits\Eloquent;


use Illuminate\Database\Eloquent\Builder;

trait FilterScopes
{
    public function scopeApplyFilters(Builder $query, $filters)
    {
        foreach ($filters as $filter) {
            $query = $this->scopeApplyFilter($query, ...$filter);
        }
        return $query;
    }

    public function scopeApplyFilter(Builder $query, string $column, $method, $value = null)
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