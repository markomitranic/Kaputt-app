<?php

namespace Service\Transformer;

use Model\Item;

class ItemModelTransformer
{
    public function hydrate(array $entry)
    {
        $item = new Item();

        $item->setName($entry['name']);
        $item->setSlug($entry['slug']);
        $item->setDescription($entry['description']);
        $item->setIcon($entry['icon']);

        return $item;
    }
}