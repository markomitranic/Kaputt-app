<?php

namespace App\Service\Movie\Transformer;

interface ConditionTransformer
{

    public function transform(string $weatherCondition): string;

}
