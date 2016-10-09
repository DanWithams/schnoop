<?php

namespace MilesAsylum\Schnoop\SchemaFactory;

use MilesAsylum\Schnoop\Schnoop;
use MilesAsylum\Schnoop\Schema\DatabaseInterface;
use MilesAsylum\Schnoop\Schema\TableInterface;
use MilesAsylum\SchnoopSchema\MySQL\Trigger\TriggerInterface;

interface SchemaBuilderInterface
{
    /**
     * @param Schnoop $schnoop
     */
    public function setSchnoop(Schnoop $schnoop);

    /**
     * @param $databaseName
     * @return DatabaseInterface
     */
    public function fetchDatabase($databaseName);

    /**
     * @param $databaseName
     * @param $tableName
     * @return TableInterface
     */
    public function fetchTable($databaseName, $tableName);

    /**
     * @param $databaseName
     * @param $tableName
     * @return TriggerInterface[]
     */
    public function fetchTriggers($databaseName, $tableName);
}
