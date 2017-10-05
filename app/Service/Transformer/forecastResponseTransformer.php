<?php

namespace Service\Transformer;


use Model\Day;
use Model\Item;

class forecastResponseTransformer
{

    /**
     * @param array $forecast
     * @return array
     */
    public function transform(array $forecast)
    {
        $response = [];

        $response['location'] = [
            'name' => $forecast['location']->name,
            'country' => $forecast['location']->country,
            'latitude' => $forecast['location']->lat,
            'longtitude' => $forecast['location']->lon,
            'current_condition' => ($forecast['weather'][0]) ? $forecast['weather'][0]->getConditionCode() : 0
        ];

        $response['weather'] = $this->getWeather($forecast['weather']);
        $response['clothes'] = $this->getClothes($forecast['items']);

        return $response;
    }

    /**
     * @param Day[] $days
     * @return array
     */
    private function getWeather(array $days)
    {
        $weather = [];

        foreach ($days as $day) {
            $weather[] = [
                'date' => $day->getDate()->format('Y-m-d'),
                'day' => $day->getDayName(),
                'temperature' => $day->getTemperature().'°C',
                'condition' => $day->getCondition(),
                'icon' => $day->getIcon()
            ];
        }

        return $weather;
    }

    /**
     * @param Item[] $items
     * @return array
     */
    public function getClothes(array $items)
    {
        $clothes = [];

        foreach ($items as $item) {
            $clothes[] = [
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'icon' => $item->getIcon().'http://cdn.apixu.com/weather/64x64/day/113.png'
            ];
        }

        return $clothes;
    }

}