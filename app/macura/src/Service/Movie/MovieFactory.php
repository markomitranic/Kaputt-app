<?php

namespace App\Service\Movie;

use App\Service\Movie\Transformer\ConditionTransformer;

class MovieFactory
{

    /**
     * @var ConditionTransformer
     */
    private $transformer;

    public function __construct(ConditionTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function create(string $weatherCondition): string
    {
        $weatherCondition = $this->transformer->transform($weatherCondition);

        if (in_array($weatherCondition, ConditionMovieTypes::ALLOWED_TYPES)) {
            return $weatherCondition;
        } else {
            return ConditionMovieTypes::CLEAR_DAY;
        }
    }

}
