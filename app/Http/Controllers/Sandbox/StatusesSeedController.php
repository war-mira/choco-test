<?php

namespace App\Http\Controllers\Sandbox;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Model\System\Status;

class StatusesSeedController extends Controller
{
    public function seedDoctorStatuses()
    {
        $statuses = [
            0 => 'Скрыт',
            1 => 'Опубликован',
            2 => 'Модерация'
        ];
        $targetType = Doctor::class;
        $targetColumn = 'status';
        foreach ($statuses as $code => $name) {
            Status::query()->create([
                'target_type' => $targetType,
                'target_column' => $targetColumn,
                'code' => $code,
                'name' => $name
            ]);
        }
    }
}
