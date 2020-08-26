<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use EraName\EraNameFactory;

class EraNameFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testHeisei()
    {
        $name = 'heisei';
        $obj = new EraNameFactory();
        $gengo = $obj->createInstance($name);
        var_dump(strval($gengo));

        $this->assertEquals($name, strval($gengo));
    }
}