<?php

namespace App\Service\Clothes;

use App\Service\Clothes\Adapter\Adapter;

final class ClothesProvider
{

    /**
     * @var Adapter
     */
    private $adapter;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * @return Item[]
     */
    public function getAll(): array
    {
        return $this->adapter->getAll();
    }

    /**
     * @param string $slug
     * @return Item
     * @throws \Exception
     */
    public function getItemBySlug(string $slug): Item
    {
        if (!in_array($slug, ClothesType::ALLOWED_TYPES)) {
            throw new \Exception('The provided clothes slug is not allowed: ' . $slug . ' Allowed values are: ' . implode(', ', ClothesType::ALLOWED_TYPES));
        }

        return $this->adapter->getItemBySlug($slug);
    }

}
