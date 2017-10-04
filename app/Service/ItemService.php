<?php

namespace Service;

use Model\Day;
use Model\WeatherCondition;
use Service\Decider\Decider;
use Service\Decider\RainDecider;
use Service\Decider\SnowDecider;
use Service\Decider\TemperatureDecider;
use Service\Decider\WindDecider;
use Service\Transformer\conditionCodeTransformer;

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
        $condition->setWindSpeed($day->getWindSpeed());

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
            new TemperatureDecider(),
            new WindDecider(),
            new RainDecider(),
            new SnowDecider()
        ];
    }

}