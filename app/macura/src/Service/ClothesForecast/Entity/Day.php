<?php

namespace App\Service\ClothesForecast\Entity;

use App\Service\Clothes\Item;
use App\Service\DarkSky\Transformer\DateToDateString;
use App\Service\Transformer\DateRangeTransformer;
use DateTimeInterface;

class Day implements \JsonSerializable
{

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * @var WeatherConditions
     */
    private $weatherConditions;

    /**
     * @var Item[]
     */
    private $clothes;

    public function __construct(
        DateTimeInterface $date,
        WeatherConditions $weatherConditions,
        Item ...$clothes
    ) {
        $this->date = $date;
        $this->weatherConditions = $weatherConditions;
        $this->clothes = $clothes;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return WeatherConditions
     */
    public function getWeatherConditions(): WeatherConditions
    {
        return $this->weatherConditions;
    }

    /**
     * @return Item[]
     */
    public function getClothes(): array
    {
        return $this->clothes;
    }

    public function clothingItemExists(string $slug): bool
    {
        foreach ($this->getClothes() as $item) {
            if ($item->getSlug() === $slug) {
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'date' => $this->getDate()->format(DateRangeTransformer::DATE_FORMAT),
            'weatherConditions' => $this->getWeatherConditions(),
            'clothes' => $this->getClothes()
        ];
    }
}
