<?php

declare(strict_types=1);

namespace GoF\Proxy\Dao;

use GoF\Proxy\Entity\Item;

class DbItemDao implements ItemDaoInterface
{
    public function findById(int $itemId): Item
    {
        $fp = fopen('item_data.txt', 'r');

        /**
         * ヘッダ行を抜く.
         */
        $dummy = fgets($fp, 4096);

        $item = null;
        while ($buffer = fgets($fp, 4096)) {
            $id = trim(substr($buffer, 0, 10));
            $name = trim(substr($buffer, 10));

            if ($itemId === (int) $id) {
                $item = new Item((int) $id, $name);
                break;
            }
        }

        fclose($fp);

        return $item;
    }
}
