<?php

namespace Service\Decider;


use Model\WeatherCondition;

class TemperatureDecider implements Decider
{

    const INFERNO = ['t-shirt', 'shorts', 'sandals', 'light-sneakers', 'water', 'umbrella'];
    const EXTREMELY_HOT = ['t-shirt', 'shorts', 'sandals', 'light-sneakers', 'water'];
    const SUMMER = ['t-shirt', 'sleeved-shirt', 'shorts', 'sandals', 'light-sneakers'];
    const SPRING = ['t-shirt', 'sleeved-shirt', 'hoodie', 'light-pants', 'jeans', 'light-sneakers', 'sneakers'];
    const CHILLS = ['t-shirt', 'sleeved-shirt', 'hoodie', 'jeans', 'sweat-pants', 'sneakers', 'shoes', 'Vest', 'Jacket'];
    const COLD = ['t-shirt', 'hoodie', 'sweater', 'jeans', 'sweat-pants', 'sneakers', 'shoes', 'vest', 'Jacket', 'cap'];
    const WINTER = ['t-shirt', 'hoodie', 'sweater', 'jeans', 'sweat-pants', 'shoes', 'vest', 'heavy-jacket', 'cap', 'scarf'];
    const EXTREMELY_COLD = ['t-shirt', 'sweater', 'snow-pants', 'jeans', 'sweat-pants', 'winter-shoes', 'vest', 'heavy-jacket', 'winter-hat', 'scarf'];

    /**
     * @param WeatherCondition $weatherCondition
     * @return array
     */
    public function decide(WeatherCondition $weatherCondition)
    {

        if ($weatherCondition->getTemperature() >= 35) {
            return self::INFERNO;
        }

        if ($weatherCondition->getTemperature() >= 27) {
            return self::EXTREMELY_HOT;
        }

        if (22 <= $weatherCondition->getTemperature() && $weatherCondition->getTemperature() < 27) {
            return self::SUMMER;
        }

        if (17 <= $weatherCondition->getTemperature() && $weatherCondition->getTemperature() < 22) {
            return self::SPRING;
        }

        if (10 <= $weatherCondition->getTemperature() && $weatherCondition->getTemperature() < 17) {
            return self::CHILLS;
        }

        if (5 <= $weatherCondition->getTemperature() && $weatherCondition->getTemperature() < 10) {
            return self::COLD;
        }

        if (0 <= $weatherCondition->getTemperature() && $weatherCondition->getTemperature() < 5) {
            return self::WINTER;
        }

        if (0 >= $weatherCondition->getTemperature()) {
            return self::EXTREMELY_COLD;
        }

        return [];
    }

}