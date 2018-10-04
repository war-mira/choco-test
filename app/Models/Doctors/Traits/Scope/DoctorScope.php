<?php

namespace App\Models\Doctors\Traits\Scope;

use App\Enums\OrderStatus;
use App\Helpers\SessionContext;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait DoctorScope
 * @package App\Models\Doctors\Traits\Scope
 */
trait DoctorScope
{
    /**
     * @param $query
     * @param $city_id
     *
     * @return mixed
     */
    public function scopeInCities($query, $city_id)
    {
        return $query->where('city_id', $city_id);
    }

    /**
     * @param      $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopePublic($query, $status = true)
    {
        return $query->where('status', $status);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeLocalPublic($query)
    {
        return $query->where('status', 1)->where('city_id', SessionContext::city()->id);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithOrdersCount($query)
    {
        return $query->withCount(['orders as orders_count' => function (Builder $query) {
            $query->whereIn('status', [OrderStatus::VISIT_CHECK, OrderStatus::VISIT_SUCCESS]);
        }]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithCommentsCount($query)
    {
        return $query->withCount([
            'comments as comments_count'          => function (Builder $query) {
                $query->where('comments.status', 1);
            },
            'comments as positive_comments_count' => function (Builder $query) {
                $query->where('comments.status', 1)->where('author_rate', '>=', 5);;
            },
            'comments as negative_comments_count' => function (Builder $query) {
                $query->where('comments.status', 1)->where('author_rate', '<', 5);
            }
        ]);
    }
}
