<?php

namespace App\Service\ClothesForecast;

use App\Service\ClothesForecast\Entity\Day;
use App\Service\DarkSky\WeatherProvider;
use DateTimeInterface;

class ClothesForecastService
{

    /**
     * @var WeatherProvider
     */
    private $weatherProvider;

    /**
     * @var ForecastResolver
     */
    private $forecastResolver;

    /**
     * @var DayFactory
     */
    private $dayFactory;

    /**
     * @var WeatherConditionsFactory
     */
    private $weatherConditionsFactory;

    public function __construct(
        WeatherProvider $weatherProvider,
        ForecastResolver $forecastResolver,
        DayFactory $dayFactory,
        WeatherConditionsFactory $weatherConditionsFactory
    ) {
        $this->weatherProvider = $weatherProvider;
        $this->forecastResolver = $forecastResolver;
        $this->dayFactory = $dayFactory;
        $this->weatherConditionsFactory = $weatherConditionsFactory;

    }

    /**
     * @param float $lat
     * @param float $len
     * @param DateTimeInterface ...$dates
     * @return Day[]
     * @throws \Exception
     */
    public function getClothesForecast(float $lat, float $len, DateTimeInterface ...$dates): array {
        $weatherForecastPeriod = $this->weatherProvider->getWeather($lat, $len, ...$dates);

        /** @var Day[] $clothesForecast */
        $clothesForecast = [];
        $datesIndex = 0;

        foreach ($weatherForecastPeriod as $dailyForecast) {
            $day = $this->dayFactory->create(
                $dates[$datesIndex],
                $this->weatherConditionsFactory->create($dailyForecast),
                ...[]
            );

            $clothesForecast[] = $this->forecastResolver->resolve($day);
            $datesIndex++;
        }

        return $clothesForecast;
    }

}
