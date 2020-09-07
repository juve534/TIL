<?php

declare(strict_types=1);

require_once '../../vendor/autoload.php';

use GoF\Proxy\Dao\DbItemDao;
use GoF\Proxy\Dao\ItemDaoInterface as ItemDao;
use GoF\Proxy\Dao\MockItemDao;
use GoF\Proxy\Proxy\ItemDaoProxy;

function execute(ItemDao $dao, bool $use_proxy = false)
{
    if ($use_proxy === true) {
        $dao = new ItemDaoProxy($dao);
    }

    for ($itemId = 1; $itemId <= 3; $itemId++) {
        $item = $dao->findById($itemId);
        printf('ID=%sの商品は「%s」です%s', $itemId, $item->getName(), PHP_EOL);
    }

    /**
     * 再度データを取得.
     */
    $itemId = 2;
    $item = $dao->findById($itemId);
    printf('ID=%sの商品は「%s」です%s', $itemId, $item->getName(), PHP_EOL);
}

echo '■DbItemDao＋Proxyなし' . PHP_EOL;
execute(new DbItemDao());

echo '■MockItemDao＋Proxyなし' . PHP_EOL;
execute(new MockItemDao());

echo '■DbItemDao＋Proxyあり' . PHP_EOL;
execute(new DbItemDao(), true);

echo '■MockItemDao＋Proxyあり' . PHP_EOL;
execute(new MockItemDao(), true);
