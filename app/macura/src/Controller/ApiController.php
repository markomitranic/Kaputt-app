<?php

namespace App\Controller;

use App\Service\DarkSky\WeatherService;
use Symfony\Component\HttpFoundation\JsonResponse;
use GeoIp2\Database\Reader;

class ApiController
{

    public function forecast(WeatherService $weather): JsonResponse
    {
        return new JsonResponse($weather->getWeather());
    }
    public function autocomplete()
    {
        $reader = new Reader('/usr/local/share/GeoIP/GeoIP2-City.mmdb');
        $record = $reader->('128.101.101.101');

        print($record->country->isoCode . "\n"); // 'US'
        print($record->country->name . "\n"); // 'United States'
        print($record->country->names['zh-CN'] . "\n"); // '美国'

        print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
        print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

        print($record->city->name . "\n"); // 'Minneapolis'

        print($record->postal->code . "\n"); // '55455'

        print($record->location->latitude . "\n"); // 44.9733
        print($record->location->longitude . "\n"); // -93.2323



        return new JsonResponse('dada');
    }

    public function sanityCheck(): JsonResponse
    {
        return new JsonResponse('dada');
    }
}
