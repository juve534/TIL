<?php

declare(strict_types=1);

namespace GoF\Proxy\Entity;

class Item
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
}
