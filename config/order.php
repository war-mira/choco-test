<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.02.2018
 * Time: 13:46
 */

use App\Enums\OrderStatus;

return [
    'status_tree' => [
        OrderStatus::NEW,
        OrderStatus::VISIT_CHECK,
        OrderStatus::VISIT_SUCCESS,
        OrderStatus::VISIT_CHECK,
    ]
];