<?php

namespace Service;

use Model\Day;
use Model\WeatherCondition;
use Service\Decider\Decider;
use Service\Decider\TemperatureDecider;

class ItemService
{

    /**
     * @param Day $day
     * @return array
     */
    public function getItemsForDay(Day $day)
    {
        $items = [];

        $condition = new WeatherCondition();
        $condition->setTemperature($day->getTemperature());
        $condition->setConditionCode($day->getConditionCode());

        foreach ($this->getDeciders() as $decider) {
            $items = array_unique(array_merge($items, $decider->decide($condition)), SORT_STRING);
        }

        return $items;
    }

    /**
     * @return Decider[]
     */
    private function getDeciders()
    {
        return [
            new TemperatureDecider()
        ];
    }

}