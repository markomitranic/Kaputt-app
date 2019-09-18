<?php

namespace App\Service\Clothes\Adapter;

use App\Service\Clothes\Item;

interface Adapter {

    /**
     * @return Item[]
     */
    public function getAll(): array;

    public function getItemBySlug(string $slug): Item;

}
