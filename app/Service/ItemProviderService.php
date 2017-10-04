<?php

namespace Service;

use Model\Item;
use Service\Transformer\ItemModelTransformer;

class ItemProviderService
{

    const FILE_LOCATION = '/items.json';

    /**
     * @return Item[]
     */
    public function getModelData()
    {
        $db = file_get_contents(dirname(__DIR__).self::FILE_LOCATION);
        $db = json_decode($db, true);

        $data = [];

        foreach ($db as $entry) {
            $data[] = $this->getItemModelTransformer()->hydrate($entry);
        }

        return $data;
    }

    /**
     * @return ItemModelTransformer
     */
    private function getItemModelTransformer()
    {
        return new ItemModelTransformer();
    }

}