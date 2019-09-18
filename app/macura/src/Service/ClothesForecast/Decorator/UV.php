<?php

namespace App\Service\ClothesForecast\Decorator;

use App\Service\Clothes\ClothesType;
use App\Service\ClothesForecast\Entity\Day;

class UV extends Decorator
{

    public function shouldHandle(Day $dailyClothesForecast): bool
    {
        if ($dailyClothesForecast->getWeatherConditions()->getUvIndex() > 7) {
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
        if ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 32) {
            return [
                ClothesType::PARASOL,
                ClothesType::SUNSHADES,
                ClothesType::UV_PROTECTION
            ];
        } elseif ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 22) {
            return [
                ClothesType::CAP,
                ClothesType::SUNSHADES,
                ClothesType::UV_PROTECTION
            ];
        }

        return [
            ClothesType::CAP,
            ClothesType::SUNSHADES
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
