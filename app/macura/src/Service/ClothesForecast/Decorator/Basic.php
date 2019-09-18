<?php

namespace App\Service\ClothesForecast\Decorator;

use App\Service\Clothes\ClothesType;
use App\Service\ClothesForecast\Entity\Day;

class Basic extends Decorator
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
        return [
            ClothesType::SOCKS,
            ClothesType::UNDERPANTS
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
