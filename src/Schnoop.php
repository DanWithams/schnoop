<?php

namespace MilesAsylum\Schnoop;

use MilesAsylum\Schnoop\Inspector\InspectorInterface;
use MilesAsylum\Schnoop\Inspector\MySQLInspector;
use MilesAsylum\Schnoop\Schema\Table;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\Column\ColumnMapper;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\Constraint\ForeignKeyMapper;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\Constraint\IndexMapper;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\Database\DatabaseMapper;
use MilesAsylum\Schnoop\SchemaFactory\DataTypeFactory;
use MilesAsylum\Schnoop\Schema\Database;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\SetVar\SqlModeFactory;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\Trigger\TriggerMapper;
use MilesAsylum\Schnoop\SchemaFactory\SchemaBuilder;
use MilesAsylum\Schnoop\SchemaFactory\MySQL\Table\TableMapper;
use MilesAsylum\SchnoopSchema\MySQL\Database\DatabaseInterface;
use MilesAsylum\SchnoopSchema\MySQL\Table\TableInterface;
use PDO;
use MilesAsylum\Schnoop\SchemaFactory\SchemaBuilderInterface;

class Schnoop
{
    /**
     * @var InspectorInterface
     */
    protected $dbInspector;

    /**
     * @var SchemaBuilderInterface
     */
    protected $dbBuilder;

    /**
     * @var Database[]
     */
    protected $loadedDatabase = [];

    /**
     * Schnoop constructor.
     * @param InspectorInterface $dbInspector
     * @param SchemaBuilderInterface $dbBuilder
     */
    public function __construct(
        InspectorInterface $dbInspector,
        SchemaBuilderInterface $dbBuilder
    ) {
        $this->dbInspector = $dbInspector;
        $this->dbBuilder = $dbBuilder;
    }

    public function getDatabaseList()
    {
        return $this->dbInspector->fetchDatabaseList();
    }

    /**
     * @param $databaseName
     * @return bool
     */
    public function hasDatabase($databaseName)
    {
        return in_array($databaseName, $this->dbInspector->fetchDatabaseList());
    }

    public function getDatabase($databaseName = null)
    {
        if ($databaseName === null) {
            $databaseName = $this->dbInspector->fetchActiveDatabase();
        }

        $databaseName = strtolower($databaseName);

        if (!isset($this->loadedDatabase[$databaseName])) {
            $this->loadedDatabase[$databaseName] = $this->dbBuilder->fetchDatabase($databaseName);
        }

        return $this->loadedDatabase[$databaseName];
    }

    public function getTableList($databaseName)
    {
        return $this->dbInspector->fetchTableList($databaseName);
    }

    public function getTable($databaseName, $tableName)
    {
        return $this->dbBuilder->fetchTable($databaseName, $tableName);
    }

    public function hasTable($databaseName, $tableName)
    {
        return in_array($tableName, $this->dbInspector->fetchTableList($databaseName));
    }

    public function getTriggers($databaseName, $tableName)
    {
        return $this->dbBuilder->fetchTriggers($databaseName, $tableName);
    }

    public static function createSelf(PDO $pdo)
    {
        return new self(
            new MySQLInspector(
                $pdo
            ),
            new SchemaBuilder(
                new DatabaseMapper($pdo),
                new TableMapper($pdo),
                new ColumnMapper($pdo, DataTypeFactory::createSelf()),
                new IndexMapper($pdo),
                new ForeignKeyMapper($pdo),
                new TriggerMapper($pdo, new SqlModeFactory())
            )
        );
    }
}
