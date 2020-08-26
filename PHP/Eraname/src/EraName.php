<?php

declare(strict_types=1);

namespace EraName;

abstract class EraName
{
    public function __toString()
    {
        $classArray = explode('\\', get_class($this));
        $roleName = (end($classArray));

        return lcfirst($roleName);
    }
}