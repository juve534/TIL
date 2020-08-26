<?php

declare(strict_types=1);

namespace EraName;

class EraNameFactory
{
    public function createInstance(string $name)
    {
        $className = __NAMESPACE__ . '\\' . ucfirst($name);

        return new $className();
    }
}