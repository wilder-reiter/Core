<?php

namespace Wildgame\Database;

/**
 * Wrapper for executing raw sql statements and transactions
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2020 Lisa Saalfrank
 */
class Database extends Connection {

    /**
     * @param   array   $config
     */
    public function __construct(array $config) {
        parent::__construct($config);
    }

    /**
     * @param   string  $sql
     * @param   array   $params
     *
     * @return  array
     */
    public function select(string $sql, array $params = []) : array
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param   string  $sql
     * @param   array   $params
     *
     * @return  int
     */
    public function insert(string $sql, array $params = []) : int {
        return $this->cud($sql, $params);
    }

    /**
     * @param   string  $sql
     * @param   array   $params
     *
     * @return  int
     */
    public function update(string $sql, array $params = []) : int {
        return $this->cud($sql, $params);
    }

    /**
     * @param   string  $sql
     * @param   array   $params
     *
     * @return  int
     */
    public function delete(string $sql, array $params = []) : int {
        return $this->cud($sql, $params);
    }

    /**
     * @param   callable    $queries
     * @param   array       $args
     *
     * @return  void
     */
    public function transaction(callable $queries, array $args = [])
    {
        // Begin the transaction
        $this->connection->beginTransaction();

        // Try to execute the callable with the queries
        try {
            call_user_func_array($queries, $args);
            $this->connection->commit();
        }

        // Will handle any exceptions that are thrown and roll back
        catch(\PDOException $e) {
            echo 'Transaction failed: ' . $e->getMessage();
            $this->connection->rollBack();
        }
    }
}
