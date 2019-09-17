<?php

namespace Service\Decider;


use Model\WeatherCondition;

class WindDecider implements Decider
{
    const ITEM_SLUGS = ['overcoat', 'windbreaker'];

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
            } else {
                unset($items[1]);
            }

            return $items;
        }

        return [];
    }
}