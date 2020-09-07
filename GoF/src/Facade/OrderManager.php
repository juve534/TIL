<?php

declare(strict_types=1);

namespace GoF\Facade;

use GoF\Facade\Dao\ItemDao;
use GoF\Facade\Dao\OrderDao;
use GoF\Facade\Entity\Order;

class OrderManager
{
    public static function order(Order $order): void
    {
        $itemDao = ItemDao::getInstance();
        foreach ($order->getItems() as $orderItem) {
            $itemDao->setAside($orderItem);
        }

        OrderDao::createOrder($order);
    }
}
