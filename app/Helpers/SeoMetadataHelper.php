<?php

namespace App\Helpers;

use App\City;
use App\Interfaces\ISeoMetadata;

class SeoMetadataHelper
{
    /* TODO move to DB */
    const CityPP = [
        6 => 'Алматы',
        7 => 'Астане'
    ];

    public static function getMeta($model, City $city = null)
    {
        if(!$model instanceof ISeoMetadata) {
            return null;
        }

        $title = $model->getMetaTitle();
        $description = $model->getMetaDescription();
        $keywords = $model->getMetaKeywords();
        $h1 = $model->getMetaHeader();
        $seoText = $model->getSeoText();
        $robots = self::getMetaRobots();

        $phs = self::getCityPhs($city);
        $meta = compact('title', 'description', 'keywords', 'h1', 'seoText', 'robots');

        self::replacePlaceHolders($meta, $phs);

        return $meta;
    }

    private static function getMetaRobots()
    {
        $inputs = \Request::all();

        $filter_params = [
        "sort",
        "child",
        "order",
        "exp_range",
        "price_range",
        "rate_range",
        "ambulatory"
        ];

        if(!empty(array_intersect(collect($inputs)->keys()->toArray(), $filter_params))){
            return "noindex, nofollow";
        }
        if(isset($inputs["page"])){
            return "noindex, follow";
        }
    }

    private static function getCityPP($cityId = null)
    {
        return self::CityPP[$cityId] ?? '';
    }

    private static function getCityPhs(City $city)
    {
        $cityName = $city ? $city->name : '';
        $cityPP = $city ? self::getCityPP($city->id) : '';

        return [
            ':city_name' => $cityName,
            ':city_pp'   => $cityPP,
        ];
    }

    private static function replacePlaceHolders(&$meta, $placeholders)
    {
        foreach($meta as $attr => $val) {
            $meta[$attr] = strtr($val, $placeholders);
        }
    }
}