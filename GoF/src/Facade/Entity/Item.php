<?php

declare(strict_types=1);

namespace GoF\Facade\Entity;

class Item
{
    private int $id;
    private string $name;
    private int $price;

    public function __construct(int $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return int|int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
