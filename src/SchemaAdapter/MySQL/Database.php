<?php

namespace MilesAsylum\Schnoop\SchemaAdapter\MySQL;

use MilesAsylum\Schnoop\Schnoop;

class Database extends \MilesAsylum\SchnoopSchema\MySQL\Database\Database implements DatabaseInterface
{
    /**
     * @var Schnoop
     */
    private $schnoop;

    /**
     * {@inheritdoc}
     */
    public function setSchnoop(Schnoop $schnoop)
    {
        $this->schnoop = $schnoop;
    }

    /**
     * {@inheritdoc}
     */
    public function getTableList()
    {
        return $this->schnoop->getTableList($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getTable($tableName)
    {
        return $this->schnoop->getTable($this->getName(), $tableName);
    }

    /**
     * {@inheritdoc}
     */
    public function hasTable($tableName)
    {
        return $this->schnoop->hasTable($this->getName(), $tableName);
    }
}