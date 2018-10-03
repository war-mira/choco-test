<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.10.2017
 * Time: 15:39
 */

namespace App\Services;


class CabinetPolicyService
{
    public function __construct($config)
    {
        $this->doctorCabinetFillable = $config['doctor']['fillable'];
        $this->medcenterCabinetFillable = $config['medcenter']['fillable'];
    }

    private $doctorCabinetFillable;
    private $medcenterCabinetFillable;

    public function filterDoctorUpdateData($data)
    {
        return array_only($data, $this->doctorCabinetFillable);
    }

    public function filterMedcenterUpdateData($data)
    {
        return array_only($data, $this->medcenterCabinetFillable);
    }

    public function serializeUpdateData($data, $model_type)
    {
        $filteredData = null;
        switch ($model_type) {
            case 'Doctor':
                $filteredData = $this->filterDoctorUpdateData($data);
                break;
            case 'Medcenter':
                $filteredData = $this->filterMedcenterUpdateData($data);
                break;
        }
        return json_encode($filteredData);
    }
}