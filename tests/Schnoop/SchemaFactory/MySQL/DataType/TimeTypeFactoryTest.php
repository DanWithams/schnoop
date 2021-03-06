<?php

namespace MilesAsylum\Schnoop\Tests\Schnoop\SchemaFactory\MySQL\DataType;

use MilesAsylum\Schnoop\PHPUnit\Framework\SchnoopTestCase;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\DataType\TimeTypeFactory;
use MilesAsylum\SchnoopSchema\MySQL\DataType\TimeType;

class TimeTypeFactoryTest extends SchnoopTestCase
{
    /**
     * @var TimeTypeFactory
     */
    protected $timeTypeFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->timeTypeFactory = new TimeTypeFactory();
    }

    /**
     * @dataProvider doRecogniseProvider
     * @param $typeStr
     */
    public function testDoRecognise($typeStr)
    {
        $this->assertTrue($this->timeTypeFactory->doRecognise($typeStr));
    }

    /**
     * @dataProvider doNotRecogniseProvider
     * @param $typeStr
     */
    public function testDoNotRecognise($typeStr)
    {
        $this->assertFalse($this->timeTypeFactory->doRecognise($typeStr));
    }

    /**
     * @dataProvider createTypeProvider
     * @param $typeStr
     * @param $precision
     */
    public function testCreateType($typeStr, $precision)
    {
        $this->timeTypeFactoryAsserts(
            TimeType::class,
            $precision,
            $this->timeTypeFactory->createType($typeStr)
        );
    }

    public function testCreateWrongType()
    {
        $this->assertFalse($this->timeTypeFactory->createType('binary(254)'));
    }

    /**
     * @see testDoRecognise
     * @return array
     */
    public function doRecogniseProvider()
    {
        return [
            ['time'],
            ['TIME'],
            ['time(4)'],
            ['TIME(4)']
        ];
    }

    /**
     * @see testDoNotRecognise
     * @return array
     */
    public function doNotRecogniseProvider()
    {
        return [
            ['varchar(255)'],
            ['time(foo)']
        ];
    }

    public function createTypeProvider()
    {
        return [
            [
                "time",
                0
            ],
            [
                "time(4)",
                4
            ]
        ];
    }
}
