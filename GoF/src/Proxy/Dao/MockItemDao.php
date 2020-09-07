<?php

declare(strict_types=1);

namespace GoF\Proxy\Dao;

use GoF\Proxy\Entity\Item;

class MockItemDao implements ItemDaoInterface
{
    public function findById(int $itemId): Item
    {
        $item = new Item($itemId, 'ダミー商品');

        return $item;
    }
}
