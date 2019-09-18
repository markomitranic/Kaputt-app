<?php

namespace App\Service\ClothesForecast;

use App\Service\ClothesForecast\Entity\WeatherConditions;
use App\Service\Movie\MovieFactory;
use DmitryIvanov\DarkSkyApi\Weather\TimeMachine;

final class WeatherConditionsFactory
{

    /**
     * @var MovieFactory
     */
    private $movieFactory;

    public function __construct(MovieFactory $movieFactory)
    {
        $this->movieFactory = $movieFactory;
    }

    public function create(TimeMachine $weatherForecast): WeatherConditions
    {
        return new WeatherConditions(
            $weatherForecast->daily()->temperatureHigh(),
            $weatherForecast->daily()->icon(),
            $this->movieFactory->create($weatherForecast->daily()->icon()),
            $weatherForecast->daily()->summary(),
            $weatherForecast->daily()->cloudCover(),
            $weatherForecast->daily()->uvIndex(),
            $weatherForecast->daily()->windSpeed()
        );
    }

}
