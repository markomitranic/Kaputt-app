<?php

namespace App\Service\ClothesForecast\Request;

use DateTimeInterface;

class RequestDTO
{

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var DateTimeInterface[]
     */
    private $dateRange;

    public function __construct(
        float $latitude,
        float $longitude,
        DateTimeInterface ...$dateRange
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->dateRange = $dateRange;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return DateTimeInterface[]
     */
    public function getDateRange(): array
    {
        return $this->dateRange;
    }

}
