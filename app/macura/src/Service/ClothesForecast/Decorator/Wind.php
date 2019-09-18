<?php

namespace App\Service\ClothesForecast\Decorator;

use App\Service\Clothes\ClothesType;
use App\Service\ClothesForecast\Entity\Day;
use App\Service\Movie\ConditionMovieTypes;

class Wind extends Decorator
{

    public function shouldHandle(Day $dailyClothesForecast): bool
    {
        if ($dailyClothesForecast->getWeatherConditions()->getWindSpeed() > 8
            || $dailyClothesForecast->getWeatherConditions()->getMovie() === ConditionMovieTypes::WIND) {
            return true;
        }

        return false;
    }

    /**
     * @param Day $dailyClothesForecast
     * @return string[]
     */
    protected function addItems(Day $dailyClothesForecast): array
    {
        if ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 15) {
            return [ClothesType::WINDBREAKER];
        }

        return [ClothesType::OVERCOAT];
    }

    /**
     * @param Day $dailyClothesForecast
     * @return string[]
     */
    protected function removeItems(Day $dailyClothesForecast): array
    {
        return [ClothesType::PARASOL];
    }

}
