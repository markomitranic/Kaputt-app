<?php

namespace App\Service\ClothesForecast;

use App\Service\Clothes\Item;
use App\Service\ClothesForecast\Entity\Day;
use App\Service\ClothesForecast\Entity\WeatherConditions;
use DateTimeInterface;

final class DayFactory
{

    public function create(DateTimeInterface $date, WeatherConditions $weatherConditions, Item ...$items): Day
    {
        return new Day(
            $date,
            $weatherConditions,
            ...$items
        );
    }

}
