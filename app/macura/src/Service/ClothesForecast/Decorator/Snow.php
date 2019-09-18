<?php

namespace App\Service\ClothesForecast\Decorator;

use App\Service\Clothes\ClothesType;
use App\Service\ClothesForecast\Entity\Day;
use App\Service\Movie\ConditionMovieTypes;

class Snow extends Decorator
{

    public function shouldHandle(Day $dailyClothesForecast): bool
    {
        if ($dailyClothesForecast->getWeatherConditions()->getMovie() === ConditionMovieTypes::SNOW) {
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
        return [
            ClothesType::SCARF,
            ClothesType::WINTER_HAT,
            ClothesType::GLOVES
        ];
    }

    /**
     * @param Day $dailyClothesForecast
     * @return string[]
     */
    protected function removeItems(Day $dailyClothesForecast): array
    {
        return [];
    }

}
