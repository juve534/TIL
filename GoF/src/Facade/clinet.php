<?php

declare(strict_types=1);

require_once '../../vendor/autoload.php';

use GoF\Facade\Dao\ItemDao;
use GoF\Facade\Entity\Order;
use GoF\Facade\Entity\OrderItem;
use GoF\Facade\OrderManager;

$order = new Order();
$itemDao = ItemDao::getInstance();

$order->addItem(new OrderItem($itemDao->findById(1), 2));
$order->addItem(new OrderItem($itemDao->findById(2), 1));
$order->addItem(new OrderItem($itemDao->findById(3), 3));

/*
 * 注文処理はこの1行だけ
 */
OrderManager::order($order);
