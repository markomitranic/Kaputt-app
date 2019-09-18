<?php

namespace App\Service\ClothesForecast;

use App\Service\ClothesForecast\Decorator\Decorator;
use App\Service\ClothesForecast\Entity\Day;

class ForecastResolver
{

    /**
     * @var Decorator[]
     */
    private $decorators = [];

    public function addDecorator(Decorator $decorator): void {
        $this->decorators[] = $decorator;
    }

    public function resolve(Day $dailyClothesForecast): Day
    {
        foreach ($this->decorators as $decorator) {
            if ($decorator->shouldHandle($dailyClothesForecast)) {
                $dailyClothesForecast = $decorator->decorate($dailyClothesForecast);
            }
        }

        return $dailyClothesForecast;
    }

}
