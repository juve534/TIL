<?php

declare(strict_types=1);

namespace GoF\Proxy\Proxy;

use GoF\Proxy\Dao\ItemDaoInterface as ItemDao;

class ItemDaoProxy
{
    private ItemDao $dao;
    private array $cache;

    public function __construct(ItemDao $dao)
    {
        $this->dao = $dao;
        $this->cache = [];
    }

    public function findById($itemId)
    {
        if (array_key_exists($itemId, $this->cache)) {
            echo 'Proxyで保持しているキャッシュからデータを返します' . PHP_EOL;

            return $this->cache[$itemId];
        }

        $this->cache[$itemId] = $this->dao->findById($itemId);

        return $this->cache[$itemId];
    }
}
