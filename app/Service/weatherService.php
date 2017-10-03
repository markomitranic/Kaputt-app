<?php

namespace Service;

use DateTimeImmutable;

class weatherService
{

    public function getForecastResults($params)
    {

        $start_date = new DateTimeImmutable('2017-10-03');
        $end_date = $start_date->add(new \DateInterval('PT48H'));

        $daysDifference = $start_date->diff($end_date, true)->days;

        $forecast = $this->getApixuApiService()->getWeatherForecast($params['city'], $daysDifference);

        var_dump($forecast);
        die();

        return [];
    }

    /**
     * @return apixuApiService
     */
    private function getApixuApiService()
    {
        return new apixuApiService();
    }
}