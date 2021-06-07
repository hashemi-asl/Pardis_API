<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table. with specified columns and relations
     *
     * @param string $baseTable
     * @param string $columns
     * @param string $relation
     */
    public function selectAll($baseTable, $columns = '*', $relation = '')
    {
        $table = $baseTable;

        if (!empty($relation)) {
            $table = "{$baseTable} JOIN {$relation} ON {$baseTable}.{$relation}_id = {$relation}.id";
        }

        $statement = "SELECT {$columns} FROM {$table}";

        $statement = $this->pdo->prepare($statement);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Select requested record from a database table.
     *
     * @param string $baseTable
     * @param string $id
     * @param string $columns
     * @param string $relation
     */
    public function find($baseTable, $id, $columns = '*', $relation = '')
    {
        try {
            $table = $baseTable;

            if (!empty($relation)) {
                $table = "{$baseTable} JOIN {$relation} ON {$baseTable}.{$relation}_id = {$relation}.id";
            }

            $statement = "select {$columns} from {$table} where {$baseTable}.id = ?";

            $statement = $this->pdo->prepare($statement);

            $statement->execute(array($id));

            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * Insert a record into a table.
     *
     * @param string $table
     * @param array $parameters
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }

    public function execute($statement)
    {
        try {
            $this->pdo->exec($statement);
        } catch (\Exception $e) {
            //
        }
    }
}
