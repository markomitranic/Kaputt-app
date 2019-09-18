<?php

namespace App\Service\ClothesForecast\Entity;

use JsonSerializable;

class WeatherConditions implements JsonSerializable
{

    /**
     * @var float
     */
    private $temperature;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $movie;

    /**
     * @var string
     */
    private $summary;

    /**
     * The percentage of sky occluded by clouds, between 0 and 1, inclusive.
     * @var float
     */
    private $cloudCover;

    /**
     * Between 0 and 10
     * @var float
     */
    private $uvIndex;

    /**
     * Miles per hour
     * @var float
     */
    private $windSpeed;

    public function __construct(
        float $temperature,
        string $icon,
        string $movie,
        string $summary,
        float $cloudCover,
        float $uvIndex,
        float $windSpeed
    ) {
        $this->temperature = $temperature;
        $this->icon = $icon;
        $this->movie = $movie;
        $this->summary = $summary;
        $this->cloudCover = $cloudCover;
        $this->uvIndex = $uvIndex;
        $this->windSpeed = $windSpeed;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function getMovie(): string
    {
        return $this->movie;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return float
     */
    public function getCloudCover(): float
    {
        return $this->cloudCover;
    }

    /**
     * @return float
     */
    public function getUvIndex(): float
    {
        return $this->uvIndex;
    }

    /**
     * @return float
     */
    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'temperature' => $this->getTemperature(),
            'icon' => $this->getIcon(),
            'movie' => $this->getMovie(),
            'summary' => $this->getSummary(),
            'cloudCover' => $this->getCloudCover(),
            'uvIndex' => $this->getUvIndex(),
            'windSpeed' => $this->getWindSpeed()
        ];
    }
}
