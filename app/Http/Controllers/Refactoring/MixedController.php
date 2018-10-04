<?php

namespace App\Http\Controllers\Refactoring;

use App\Callback;
use App\Http\Controllers\Controller;
use App\Models\Doctors\Doctor;
use App\Order;
use Illuminate\Http\Request;

/**
 * Class MixedController
 *
 * @package App\Http\Controllers\Refactoring
 */
class MixedController extends Controller
{
    /**
     * @param \App\Models\Doctors\Doctor $doctor
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getScheduleRecords(Doctor $doctor)
    {
        $doctor->load('jobs.medcenter', 'jobs.schedules.records');

        return response()->json([
            'doctor' => $doctor,
        ]);
    }

    /**
     * @param \App\Models\Doctors\Doctor $doctor
     * @param \Illuminate\Http\Request   $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCallback(Doctor $doctor, Request $request)
    {
        $formData = $request->get('formData');

        $callback = new Callback;

        $callback = $callback->firstOrCreate([
            'client_phone' => e($formData['phone']),
        ], [
            'target_id'        => $doctor->id,
            'target_type'      => 'Doctor',
            'source'           => 'doctor_page',
            'client_name'      => implode(" ", [
                e($formData['last_name']),
                e($formData['first_name']),
            ]),
            'client_email'     => e($formData['email']),
            'client_comment'   => e($formData['text']),
            'skill_id'         => (int) $formData['doctor-skill'],
            'appointment_date' => $formData['appointment_date'],
            'appointment_time' => $formData['appointment_time'],
        ]);

        if ($callback) {
            return response()->json([
                'message'     => "Успех!",
                'callback'    => $callback,
                'status_code' => 200,
            ]);
        }

        return response()->json([
            'message'     => "Возникла ошибка!",
            'status_code' => 500,
        ], 500);
    }

    /**
     * @param \App\Models\Doctors\Doctor $doctor
     * @param \Illuminate\Http\Request   $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAppointment(Doctor $doctor, Request $request)
    {
        $formData = $request->get('formData');

        $appointment = new Order;

        $appointment = $appointment->fill([
            'doc_id'           => $doctor->id,
            'med_id'           => (int) $formData['med_center_id'],
            'client_name'      => implode(" ", [
                e($formData['last_name']),
                e($formData['first_name']),
            ]),
            'phone'            => e($formData['phone']),
            'email'            => e($formData['email']),
            'problem'          => e($formData['text']),
            'skill_id'         => $formData['doctor-skill'],
            'callback_id'      => (int) $formData['callback_id'],
            'appointment_date' => $formData['appointment_date'],
            'appointment_time' => $formData['appointment_time'],
        ]);

        if ($appointment->save()) {
            return response()->json([
                'message'     => "Успех!",
                'status_code' => 200,
            ]);
        }

        return response()->json([
            'message'     => "Возникла ошибка!",
            'status_code' => 500,
        ], 500);
    }
}
