<?php

namespace App\Service\DarkSky;

use DmitryIvanov\DarkSkyApi\DarkSkyApi;

class WeatherService
{

    /**
     * @var DarkSkyApi
     */
    private $darkskyClient;

    public function __construct(string $apiKey)
    {
        $this->darkskyClient = new DarkSkyApi($apiKey);
    }

    public function getWeather()
    {
        $forecast = $this->darkskyClient
            ->location(20,44)
            ->units('si')
            ->language('en')
            ->forecast();

        return $forecast->daily()->toArray();
    }

}
