<?php

namespace App\Service\ClothesForecast\Decorator;

use App\Service\Clothes\ClothesType;
use App\Service\ClothesForecast\Entity\Day;

class Temperature extends Decorator
{

    public function shouldHandle(Day $dailyClothesForecast): bool
    {
        return true;
    }

    /**
     * @param Day $dailyClothesForecast
     * @return string[]
     */
    protected function addItems(Day $dailyClothesForecast): array
    {
        if ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 27) {
            return [
                ClothesType::T_SHIRT,
                ClothesType::SHORTS,
                ClothesType::SANDALS,
                ClothesType::WATER
            ];
        } elseif ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 22) {
            return [
                ClothesType::T_SHIRT,
                ClothesType::SHORTS,
                ClothesType::LIGHT_SNEAKERS,
                ClothesType::WATER
            ];
        } elseif ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 17) {
            return [
                ClothesType::T_SHIRT,
                ClothesType::SLEEVED_SHIRT,
                ClothesType::LIGHT_PANTS,
                ClothesType::LIGHT_SNEAKERS
            ];
        } elseif ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 10) {
            return [
                ClothesType::T_SHIRT,
                ClothesType::SLEEVED_SHIRT,
                ClothesType::HOODIE,
                ClothesType::JEANS,
                ClothesType::SWEAT_PANTS,
                ClothesType::SNEAKERS,
                ClothesType::VEST
            ];
        } elseif ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 5) {
            return [
                ClothesType::T_SHIRT,
                ClothesType::HOODIE,
                ClothesType::SWEATER,
                ClothesType::JEANS,
                ClothesType::SWEAT_PANTS,
                ClothesType::SHOES,
                ClothesType::JACKET
            ];
        } elseif ($dailyClothesForecast->getWeatherConditions()->getTemperature() > 0) {
            return [
                ClothesType::T_SHIRT,
                ClothesType::SWEATER,
                ClothesType::JEANS,
                ClothesType::SHOES,
                ClothesType::OVERCOAT,
                ClothesType::SCARF,
                ClothesType::WINTER_HAT,
                ClothesType::GLOVES
            ];
        }

        return [
            ClothesType::T_SHIRT,
            ClothesType::SWEATER,
            ClothesType::HEAVY_PANTS,
            ClothesType::WINTER_SHOES,
            ClothesType::HEAVY_JACKET,
            ClothesType::WINTER_HAT,
            ClothesType::SCARF,
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
