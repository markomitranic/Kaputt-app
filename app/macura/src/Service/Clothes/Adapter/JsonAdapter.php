<?php


namespace App\Service\Clothes\Adapter;

use App\Service\Clothes\Item;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;

class JsonAdapter implements Adapter
{

    const FILE_LOCATION = '/items.json';

    /**
     * @var Item[]
     */
    private $itemRegistry = [];

    /**
     * @var CacheInterface
     */
    private $cacheAdapter;

    public function __construct(CacheInterface $cacheAdapter)
    {
        $this->cacheAdapter = $cacheAdapter;
    }

    /**
     * @return Item[]
     */
    public function getAll(): array
    {
        if (!empty($this->itemRegistry)) {
            return $this->itemRegistry;
        }

        try {
            $this->itemRegistry = $this->cacheAdapter->get('clothes', function () {
                return $this->loadDataFromFile();
            });
        } catch (InvalidArgumentException $e) {
            return $this->loadDataFromFile();
        }

        return $this->itemRegistry;
    }

    /**
     * @param string $slug
     * @return Item
     * @throws \Exception
     */
    public function getItemBySlug(string $slug): Item
    {
        $items = $this->getAll();

        foreach ($items as $item) {
            if ($item->getSlug() === $slug) {
                return $item;
            }
        }

        throw new \Exception('No items found with slug: '  . $slug);
    }

    /**
     * @return Item[]
     */
    private function loadDataFromFile(): array
    {
        $db = file_get_contents(dirname(__DIR__).self::FILE_LOCATION);
        $db = json_decode($db, true);

        /** @var Item[] $items */
        $items = [];

        /** @var array $entry */
        foreach ($db as $entry) {
            $items[] = $this->hydrateItem($entry);
        }

        return $items;
    }

    public function hydrateItem(array $entry): Item
    {
        return new Item(
            $entry['name'],
            $entry['slug'],
            $entry['description']
        );
    }

}
