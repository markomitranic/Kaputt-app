<?php

namespace App\Service\DarkSky\Transformer;

use DateTimeInterface;

abstract class DateToDateString
{

    /** @var string  */
    const DATETIME_FORMAT = 'Y-m-j G:i:s';

    /**
     * @param DateTimeInterface[] $dates
     * @return string[]
     */
    public static function transform(DateTimeInterface ...$dates): array
    {

        $dateStrings = [];

        foreach ($dates as $date) {
            $dateStrings[] = $date->format(self::DATETIME_FORMAT);
        }

        return $dateStrings;
    }

}
