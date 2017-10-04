<?php

namespace Service\Transformer;

use DateTimeImmutable;
use Model\Day;
use stdClass;

class dayWeatherTransformer
{
    /**
     * @param stdClass $dayForecast
     * @return Day
     * @internal param $forecast
     */
    public function hydrate(stdClass $dayForecast)
    {
        $day = new Day();
        $day->setDate(new DateTimeImmutable($dayForecast->date));
        $day->setDayName($day->getDate()->format('d M'));
        $day->setTemperature((float) $dayForecast->day->avgtemp_c);
        $day->setCondition($dayForecast->day->condition->text);
        $day->setConditionCode($this->convertApiConditionCode($dayForecast->day->condition->code));
        $day->setIcon($dayForecast->day->condition->text);

        return $day;
    }

    /**
     * @param int $apiCode
     * @return int
     */
    private function convertApiConditionCode($apiCode)
    {
        return 1;
    }

}