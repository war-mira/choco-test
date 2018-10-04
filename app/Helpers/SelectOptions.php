<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.03.2018
 * Time: 1:24
 */

namespace App\Helpers;


use App\City;
use App\Models\Doctors\Doctor;
use App\Medcenter;
use App\Skill;

class SelectOptions
{
    public static function doctors($scopes = [])
    {
        $doctors = Doctor::query();
        foreach ($scopes as $scope) {
            $doctors = $doctors->{$scope};
        }
        $options = $doctors->orderBy('lastname')
            ->get()
            ->mapWithKeys(function ($doctor) {
                return [$doctor->id => $doctor->name];
            });
        return $options;
    }

    public static function skills($scopes = [])
    {
        $skills = Skill::query();
        foreach ($scopes as $scope) {
            $skills = $skills->{$scope};
        }
        $options = $skills->orderBy('name')
            ->get()
            ->mapWithKeys(function ($skill) {
                return [$skill->id => $skill->name];
            });
        return $options;
    }

    public static function medcenters($scopes = [])
    {
        $medcenters = Medcenter::query();
        foreach ($scopes as $scope) {
            $medcenters = $medcenters->{$scope};
        }
        $options = $medcenters->orderBy('name')
            ->get()
            ->mapWithKeys(function ($medcenter) {
                return [$medcenter->id => $medcenter->name];
            });
        return $options;
    }

    public static function cities($scopes = [])
    {
        $cities = City::query();
        foreach ($scopes as $scope) {
            $cities = $cities->{$scope};
        }
        $options = $cities->orderBy('name')
            ->get()
            ->mapWithKeys(function ($city) {
                return [$city->id => $city->name];
            });
        return $options;
    }
}