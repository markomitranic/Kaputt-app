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
        $day->setWindSpeed((float) $dayForecast->day->maxwind_kph);
        $day->setCondition($dayForecast->day->condition->text);
        $day->setConditionCode($this->getConditionCodeTransformer()->transform($dayForecast->day->condition->code));
        $day->setIcon($dayForecast->day->condition->text);

        return $day;
    }

    /**
     * @return conditionCodeTransformer
     */
    private function getConditionCodeTransformer()
    {
        return new conditionCodeTransformer();
    }

}