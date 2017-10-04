<?php

namespace Model;

class WeatherCondition
{

    /**
     * @var float
     */
    private $temperature;

    /**
     * @var int
     */
    private $conditionCode;

    /**
     * @return float
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     * @return $this
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * @return int
     */
    public function getConditionCode()
    {
        return $this->conditionCode;
    }

    /**
     * @param int $conditionCode
     * @return $this
     */
    public function setConditionCode($conditionCode)
    {
        $this->conditionCode = $conditionCode;
        return $this;
    }

}