<?php

namespace MilesAsylum\Schnoop\SchemaAdapter\MySQL;

use MilesAsylum\Schnoop\Schnoop;
use MilesAsylum\SchnoopSchema\MySQL\Table\TableInterface;

interface DatabaseInterface extends \MilesAsylum\SchnoopSchema\MySQL\Database\DatabaseInterface
{
    /**
     * @param Schnoop $schnoop
     */
    public function setSchnoop(Schnoop $schnoop);

    /**
     * @return array
     */
    public function getTableList();

    /**
     * @param $tableName
     * @return TableInterface
     */
    public function getTable($tableName);

    /**
     * @param $tableName
     * @return bool
     */
    public function hasTable($tableName);
}