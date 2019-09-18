<?php

namespace App\Service\ClothesForecast\Decorator;

use App\Service\Clothes\ClothesProvider;
use App\Service\Clothes\ClothesType;
use App\Service\Clothes\Item;
use App\Service\ClothesForecast\DayFactory;
use App\Service\ClothesForecast\Entity\Day;

abstract class Decorator
{

    /**
     * @var ClothesProvider
     */
    protected $provider;

    /**
     * @var DayFactory
     */
    protected $dayFactory;

    public function __construct(
        ClothesProvider $provider,
        DayFactory $dayFactory
    ) {
        $this->provider = $provider;
        $this->dayFactory = $dayFactory;
    }

    /**
     * @param Day $dailyClothesForecast
     * @return Day
     * @throws \Exception
     */
    public function decorate(Day $dailyClothesForecast): Day
    {
        $dailyClothesForecast = $this->removeItemsHook($dailyClothesForecast);
        $dailyClothesForecast = $this->addItemsHook($dailyClothesForecast);

        return $dailyClothesForecast;
    }

    abstract public function shouldHandle(Day $dailyClothesForecast): bool;

    /**
     * @param Day $dailyClothesForecast
     * @return Day
     */
    private function removeItemsHook(Day $dailyClothesForecast): Day
    {
        $removeSlugs = $this->removeItems($dailyClothesForecast);
        $modifiedItems = [];
        foreach ($dailyClothesForecast->getClothes() as $item) {
            if (!in_array($item->getSlug(), $removeSlugs)) {
                $modifiedItems[] = $item;
            }
        }
        return $this->dayFactory->create(
            $dailyClothesForecast->getDate(),
            $dailyClothesForecast->getWeatherConditions(),
            ...$modifiedItems
        );
    }

    /**
     * @param Day $dailyClothesForecast
     * @return Day
     * @throws \Exception
     */
    protected function addItemsHook(Day $dailyClothesForecast): Day
    {
        /** @var Item[] $items */
        $items = $dailyClothesForecast->getClothes();

        foreach ($this->addItems($dailyClothesForecast) as $itemSlug) {
            if (!$dailyClothesForecast->clothingItemExists($itemSlug)) {
                $items[] = $this->provider->getItemBySlug($itemSlug);
            }
        }

        return $this->dayFactory->create(
            $dailyClothesForecast->getDate(),
            $dailyClothesForecast->getWeatherConditions(),
            ...$items
        );
    }

    /**
     * @param Day $dailyClothesForecast
     * @return string[]
     */
    abstract protected function addItems(Day $dailyClothesForecast): array;

    /**
     * @param Day $dailyClothesForecast
     * @return string[]
     */
    abstract protected function removeItems(Day $dailyClothesForecast): array;

}
