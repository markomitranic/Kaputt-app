<?php

namespace Service;

use Model\Day;
use Service\Transformer\dayWeatherTransformer;

class weatherService
{

    public function getForecastResults($params)
    {
        $daysDifference = $params['start_date']->diff($params['end_date'], true)->days;
        $forecast = $this->getApixuApiService()->getWeatherForecast($params['city'], $daysDifference);

        $days = $this->getWeatherFromForecast($forecast);
        $items = [];

        foreach ($days as $day) {
            $items = array_unique(array_merge($items, $this->getItemService()->getItemsForDay($day)), SORT_STRING);
        }

        $items = $this->convertIntoItems($items);

        return [
            'location' => $forecast->location,
            'weather' => $days,
            'items' => $items
        ];
    }

    public function getAutocompleteResults($string)
    {
        return $this->getApixuApiService()->getAutocomplete($string);
    }

    private function getWeatherFromForecast ($forecast)
    {
        /** @var Day[] $days */
        $days = [];
        $transformer = $this->getDayWeatherTransformer();

        foreach ($forecast->forecast->forecastday as $forecastDay) {
            $days[] = $transformer->hydrate($forecastDay);
        }

        return $days;
    }

    /**
     * @param array $itemCodes
     * @return array
     */
    private function convertIntoItems(array $itemCodes)
    {
        $db = $this->getItemProvider()->getModelData();
        $items = [];

        foreach ($itemCodes as $itemCode) {
            foreach ($db as $item) {
                if ($item->getSlug() === $itemCode) {
                    $items[] = $item;
                }
            }
        }

        return $items;
    }

    /**
     * @return apixuApiService
     */
    private function getApixuApiService()
    {
        return new apixuApiService();
    }

    /**
     * @return ItemService
     */
    private function getItemService()
    {
        return new ItemService();
    }

    /**
     * @return ItemProviderService
     */
    private function getItemProvider()
    {
        return new ItemProviderService();
    }

    /**
     * @return dayWeatherTransformer
     */
    private function getDayWeatherTransformer()
    {
        return new dayWeatherTransformer();
    }

}