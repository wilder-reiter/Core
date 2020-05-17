<?php

namespace Wildgame\Database;

/**
 * Wrapper for an active database connection
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2020 Lisa Saalfrank
 */
class Connection {

    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * @param   array   $config
     */
    public function __construct(array $config) {
        $this->connect($config);
    }

    /**
     * @param   array   $config
     *
     * @return  void
     */
    private function connect(array $config)
    {
        $dns = 'mysql:host='.$config['server'].';dbname='.$config['database'];
        $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$config['charset']];

        try {
            $this->connection = new \PDO(
                $dns, $config['username'], $config['password'], $options
            );
            $this->connection->setAttribute(
                \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION
            );
        } catch (\PDOException $e) {
            echo 'Couldn\'t connect to database: ' . $e->getMessage();
            exit;
        }
    }

    /**
     * @param   string  $sql
     * @param   array   $params
     *
     * @return  \PDOStatement
     */
    private function preparedStmt(string $sql, array $params)
    {
        // Prepare SQL
        $sql = trim($sql);
        $stmt = $this->connection->prepare($sql);

        // Bind parameters
        $names = array_keys($params);
        $elements = count($names);

        for ($i = 0; $i < $elements; $i++) {
            $stmt->bindParam(':'.ltrim($names[$i],':'), $params[$names[$i]]);
        }

        // Execute statement and return
        $stmt->execute();
        return $stmt;
    }

    /**
     * @param   string  $sql
     *
     * @return  int
     */
    private function execute(string $sql) : int
    {
        $sql = trim($sql);
        $rows = $this->connection->exec($sql);
        return $rows;
    }

    /**
     * @param   string      $sql
     * @param   null|array  $params
     *
     * @return  \PDOStatement
     */
    public function query(string $sql, array $params = null)
    {
        if (is_null($params)) {
            $sql = trim($sql);
            $stmt = $this->connection->query($sql);
            return $stmt;
        }
        return $this->preparedStmt($sql, $params);
    }

    /**
     * @param   string      $sql
     * @param   array       $params
     *
     * @return  int
     */
    public function cud(string $sql, array $params = null) : int
    {
        if (is_null($params)) {
            return $this->execute($sql);
        }
        return $this->query($sql, $params)->rowCount();
    }

    /**
     * @return  void
     */
    public function disconnect() {
        $this->connection = null;
    }
}
