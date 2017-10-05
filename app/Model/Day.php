<?php

namespace Model;

use DateTimeImmutable;

class Day
{

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var string
     */
    private $dayName;

    /**
     * @var float
     */
    private $temperature;

    /**
     * @var float
     */
    private $windSpeed;

    /**
     * @var string
     */
    private $condition;

    /**
     * @var int
     */
    private $conditionCode;

    /**
     * @var string
     */
    private $icon;

    /**
     * @return DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTimeImmutable $date
     * @return $this
     */
    public function setDate(DateTimeImmutable $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDayName()
    {
        return $this->dayName;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setDayName($name)
    {
        $this->dayName = $name;
        return $this;
    }

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
     * @return float
     */
    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    /**
     * @param float $windSpeed
     * @return $this
     */
    public function setWindSpeed($windSpeed)
    {
        $this->windSpeed = $windSpeed;
        return $this;
    }

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
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

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $iconUrl
     * @return $this
     */
    public function setIcon($iconUrl)
    {
        $this->icon = 'https://'.$iconUrl;
        return $this;
    }

}
