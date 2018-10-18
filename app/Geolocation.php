<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    public $timestamps = false;

    public function getPointsForMap()
    {
        return $this->latitude.', '.$this->longitude;
    }

    public static function getFromYandexMapApi($address,$hash)
    {
        $response = \Cache::remember('coordinates_' . $hash, 60 * 24 * 7, function () use ($address) {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://geocode-maps.yandex.ru/1.x/?format=json&geocode=' . $address . '');
            $response = $response->getBody();
            $response = $response->getContents();
            $response = json_decode($response, true);
            return $response;
        });

        $firstObject = array_shift($response['response']['GeoObjectCollection']['featureMember']);
        $points = $firstObject['GeoObject']['Point']['pos'];
        $points = str_replace(' ', ', ', $points);
        return explode(', ', $points);
    }
}
