<?php

declare(strict_types=1);

namespace GoF\Facade\Dao;

use GoF\Facade\Entity\Item;
use GoF\Facade\Entity\OrderItem;

class ItemDao
{
    private static $instance;
    private array $items;

    private function __construct()
    {
        $fp = fopen(dirname(__DIR__) . '/Dao/item_data.txt', 'r');

        /**
         * ヘッダ行を抜く.
         */
        $dummy = fgets($fp, 4096);

        while ($buffer = fgets($fp, 4096)) {
            $itemId = trim(substr($buffer, 0, 10));
            $itemName = trim(substr($buffer, 10, 20));
            $itemPrice = trim(substr($buffer, 30));

            $item = new Item((int) $itemId, $itemName, (int) $itemPrice);
            $this->items[$item->getId()] = $item;
        }

        fclose($fp);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new ItemDao();
        }

        return self::$instance;
    }

    public function findById($item_id): ?Item
    {
        if (array_key_exists($item_id, $this->items)) {
            return $this->items[$item_id];
        } else {
            return null;
        }
    }

    public function setAside(OrderItem $orderItem): void
    {
        echo $orderItem->getItem()->getName() . 'の在庫引当をおこないました<br>';
    }

    /**
     * このインスタンスの複製を許可しないようにする.
     *
     * @throws \RuntimeException
     */
    final public function __clone()
    {
        throw new \RuntimeException('Clone is not allowed against ' . get_class($this));
    }
}
