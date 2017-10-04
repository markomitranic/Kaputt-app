<?php

namespace Service;

use DateTimeImmutable;

class weatherService
{

    public function getForecastResults($params)
    {

        $start_date = new DateTimeImmutable('2017-10-04');
        $end_date = $start_date->add(new \DateInterval('PT48H'));

        $daysDifference = $start_date->diff($end_date, true)->days;

        $forecast = $this->getApixuApiService()->getWeatherForecast($params['city'], $daysDifference);

        return $forecast;
    }

    public function getAutocompleteResults($string)
    {
        return $this->getApixuApiService()->getAutocomplete($string);
    }

    /**
     * @return apixuApiService
     */
    private function getApixuApiService()
    {
        return new apixuApiService();
    }
}