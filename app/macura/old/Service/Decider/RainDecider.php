<?php

namespace Service\Decider;

use Model\WeatherCondition;

class RainDecider implements Decider
{
    const ITEM_SLUGS = ['umbrella', 'overcoat', 'shoes'];

    /**
     * @param WeatherCondition $weatherCondition
     * @return array
     */
    public function decide(WeatherCondition $weatherCondition)
    {
        if ($weatherCondition->getConditionCode() === 2) {
            $items = self::ITEM_SLUGS;

            if ($weatherCondition->getTemperature() >= 17) {
                unset($items[1]);
            }

            if ($weatherCondition->getTemperature() >= 24) {
                unset($items[2]);
            }

            return $items;
        }

        return [];
    }

}