<?php

namespace App\Service\Movie\Transformer;

use App\Service\Movie\ConditionMovieTypes;

class DarkSkyIconToMovieConditionTransformer implements ConditionTransformer
{

    /** @var string  */
    const PARTLY_CLOUDY = 'partly-cloudy-day';
    /** @var string  */
    const SLEET = 'sleet';

    public function transform(string $darkSkyIconName): string
    {
        switch ($darkSkyIconName) {
            case self::PARTLY_CLOUDY:
                return ConditionMovieTypes::CLOUDY;
            case self::SLEET:
                return ConditionMovieTypes::SNOW;
            default:
                return $darkSkyIconName;
        }
    }

}
