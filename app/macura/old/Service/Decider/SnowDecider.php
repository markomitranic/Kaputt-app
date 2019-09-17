<?php

namespace Service\Decider;

use Model\WeatherCondition;

class SnowDecider implements Decider
{
    const ITEM_SLUGS = ['scarf', 'winter-hat'];

    /**
     * @param WeatherCondition $weatherCondition
     * @return array
     */
    public function decide(WeatherCondition $weatherCondition)
    {
        if ($weatherCondition->getConditionCode() === 1) {
            $items = self::ITEM_SLUGS;
            return $items;
        }

        return [];
    }

}