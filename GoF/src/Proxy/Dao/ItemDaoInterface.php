<?php

declare(strict_types=1);

namespace GoF\Proxy\Dao;

use GoF\Proxy\Entity\Item;

interface ItemDaoInterface
{
    public function findById(int $itemId): Item;
}
