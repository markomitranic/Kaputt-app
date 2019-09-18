<?php

namespace App\Service\Movie;

class ConditionMovieTypes
{

    /** @var string  */
    const CLEAR_DAY = 'clear-day';
    /** @var string  */
    const CLOUDY = 'cloudy';
    /** @var string  */
    const RAIN = 'rain';
    /** @var string  */
    const SNOW = 'snow';
    /** @var string  */
    const WIND = 'wind';
    /** @var string  */
    const FOG = 'fog';

    /** @var string[]  */
    const ALLOWED_TYPES = [
        self::CLEAR_DAY,
        self::CLOUDY,
        self::RAIN,
        self::SNOW,
        self::WIND,
        self::FOG
    ];

}
