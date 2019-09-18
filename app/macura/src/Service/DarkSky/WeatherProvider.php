<?php

namespace App\Service\DarkSky;

use App\Service\DarkSky\Transformer\DateToDateString;
use DmitryIvanov\DarkSkyApi\DarkSkyApi;
use DmitryIvanov\DarkSkyApi\Weather\Forecast;
use DmitryIvanov\DarkSkyApi\Weather\TimeMachine;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\CacheInterface;

class WeatherProvider
{

    /** @var string[]  */
    const EXCLUDE_INFORMATION = [
        'currently',
        'hourly',
        'flags'
    ];

    /**
     * @var DarkSkyApi
     */
    private $darkskyClient;

    /**
     * @var CacheInterface
     */
    private $cacheAdapter;

    public function __construct(
        string $apiKey,
        CacheInterface $cacheAdapter
    ) {
        $this->darkskyClient = new DarkSkyApi($apiKey);
        $this->cacheAdapter = $cacheAdapter;
    }

    /**
     * @param float $lat
     * @param float $lon
     * @param \DateTimeInterface[] $dates
     * @return TimeMachine[]
     * @throws \Exception
     */
    public function getWeather(float $lat, float $lon, \DateTimeInterface ...$dates): array
    {
        $dateStrings = DateToDateString::transform(...$dates);
        $cacheKey = $this->getCacheKeyFromParams($lat, $lon, ...$dateStrings);

        try {
            /** @var Forecast $weatherData */
            $weatherData = $this->cacheAdapter->get($cacheKey, function() use ($lat, $lon, $dateStrings) {
                return $this->requestWeatherData($lat, $lon, ...$dateStrings);
            });
        } catch (InvalidArgumentException $e) {
            throw new \Exception('Unable to retreive weather data from cache.', $e->getCode(), $e);
        } catch (\Throwable $e) {
            throw new \Exception('Unable to retreive weather data.', $e->getCode(), $e);
        }

        return $weatherData;
    }

    /**
     * @param float $lat
     * @param float $lon
     * @param \DateTimeInterface[] $dates
     * @return TimeMachine[]
     * @throws \Throwable
     */
    private function requestWeatherData(float $lat, float $lon, string ...$dates): array
    {
        $forecast = $this->darkskyClient
            ->location($lat, $lon)
            ->units('si')
            ->language('en')
            ->timeMachine($dates,self::EXCLUDE_INFORMATION);

        return $forecast;
    }

    private function getCacheKeyFromParams(float $lat, float $lon, string ...$dateStrings): string
    {
        $latKey = (string) round($lat, 0);
        $lonKey = (string)round($lon, 0);

        $datesKey = implode('_', $dateStrings);
        $datesKey = str_replace(' ', '-', $datesKey);
        $datesKey = str_replace(':', '-', $datesKey);

        return $latKey . $lonKey . $datesKey;
    }

}
