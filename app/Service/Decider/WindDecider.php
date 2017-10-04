<?php

namespace Service\Decider;


use Model\WeatherCondition;

class WindDecider implements Decider
{
    const ITEM_SLUGS = ['overcoat'];

    /**
     * @param WeatherCondition $weatherCondition
     * @return array
     */
    public function decide(WeatherCondition $weatherCondition)
    {
        if ($weatherCondition->getWindSpeed() > 40) {
            $items = self::ITEM_SLUGS;

            if ($weatherCondition->getTemperature() >= 13) {
                unset($items[0]);
            }

            return $items;
        }

        return [];
    }
}