<?php

namespace Service;

use DateTimeImmutable;
use Model\Day;
use Service\Transformer\dayWeatherTransformer;

class WeatherService
{

    public function getForecastResults($params)
    {
        $today = new DateTimeImmutable();
        $today = $today->setTime(0, 0, 0);

        $daysDifference = $today->diff($params['end_date'], true)->days;

        $forecast = $this->getApixuApiService()->getWeatherForecast($params['city'], $daysDifference + 1);

        $days = $this->getWeatherFromForecast($forecast);
        $days = $this->sliceDaysInterval($days, $params['start_date'], $params['end_date']);
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

    /**
     * @param Day[] $days
     * @param DateTimeImmutable $start
     * @param DateTimeImmutable $end
     * @return array
     */
    public function sliceDaysInterval($days, DateTimeImmutable $start, DateTimeImmutable $end)
    {
        foreach ($days as $key => $day) {
            if ($day->getDate() < $start) {
                unset($days[$key]);
            }
            if ($day->getDate() > $end) {
                unset($days[$key]);
            }
        }

        return array_values($days);
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
     * @return ApixuApiService
     */
    private function getApixuApiService()
    {
        return new ApixuApiService();
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