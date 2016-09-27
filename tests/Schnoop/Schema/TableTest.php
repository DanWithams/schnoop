<?php

namespace MilesAsylum\Schnoop\Tests\Schnoop\Schema;

use MilesAsylum\Schnoop\Schema\Table;
use MilesAsylum\Schnoop\Schnoop;
use MilesAsylum\SchnoopSchema\MySQL\Column\ColumnInterface;
use MilesAsylum\SchnoopSchema\MySQL\Constraint\IndexInterface;
use MilesAsylum\SchnoopSchema\MySQL\Table\TableInterface;
use PHPUnit_Framework_MockObject_Matcher_InvokedCount;
use PHPUnit_Framework_MockObject_MockObject;

class TableTest extends \PHPUnit_Framework_TestCase
{
    protected $name = 'schnoop_tbl';

    protected $databaseName = 'schnoop_db';

    /**
     * @var Table
     */
    protected $table;

    /**
     * @var Schnoop|PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockSchnoop;

    public function setUp()
    {
        parent::setUp();

        $this->mockSchnoop = $this->createMock(Schnoop::class);

        $this->table = new Table($this->databaseName, $this->name);
        $this->table->setSchnoop($this->mockSchnoop);
    }

    public function testGetTriggers()
    {
        $expectedTriggers = ['foo'];

        $this->mockSchnoop->expects($this->once())
            ->method('getTriggers')
            ->with($this->databaseName, $this->name)
            ->willReturn($expectedTriggers);

        $this->assertSame($expectedTriggers, $this->table->getTriggers());
    }
}