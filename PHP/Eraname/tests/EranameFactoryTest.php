<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use EraName\EraNameFactory;

class EraNameFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider EraNameDataProvider()
     */
    public function testEraName($name)
    {
        $obj = new EraNameFactory();
        $gengo = $obj->createInstance($name);

        $this->assertEquals($name, strval($gengo));
    }

    public function EraNameDataProvider()
    {
        return [
            '昭和' => [
                'name' => 'showa',
            ],
            '平成' => [
                'name' => 'heisei',
            ],
            '令和' => [
                'name' => 'reiwa',
            ],
        ];
    }
}