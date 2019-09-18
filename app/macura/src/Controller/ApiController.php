<?php

namespace App\Controller;

use App\Service\DarkSky\WeatherProvider;
use App\Service\Transformer\DateRangeTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{

    /**
     * @param WeatherProvider $weather
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function forecast(
        WeatherProvider $weather,
        Request $request
    ): JsonResponse {

        if (!($dateRange = $request->query->get('dateRange'))) {
            throw new \Exception('You must provide a date range. Format: ' . DateRangeTransformer::DATE_RANGE_FORMAT);
        }

        $dates = DateRangeTransformer::transform($dateRange);

        return new JsonResponse($weather->getWeather(44,20, ...$dates));
    }
}
