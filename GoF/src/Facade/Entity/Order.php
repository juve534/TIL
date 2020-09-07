<?php

declare(strict_types=1);

namespace GoF\Facade\Entity;

class Order
{
    private array $items;

    /**
     * Order constructor.
     */
    public function __construct()
    {
    }

    public function addItem(OrderItem $orderItem): void
    {
        $this->items[$orderItem->getItem()->getId()] = $orderItem;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
