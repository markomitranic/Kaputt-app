<?php

namespace Service\Decider;

use Model\WeatherCondition;

interface Decider
{
    /**
     * @param WeatherCondition $weatherCondition
     * @return array
     */
    public function decide (WeatherCondition $weatherCondition);

}