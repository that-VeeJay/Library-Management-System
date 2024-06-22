<?php

namespace classes\core;

class Database
{
    private $host = 'localhost';
    private $dbname = 'lms';
    private $dbUsername = 'root';
    private $dbPassword = '';

    public function connection()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        try {
            $conn = new \PDO($dsn, $this->dbUsername, $this->dbPassword);
            $conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $conn->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            error_log('Connection failed: ' . $e->getMessage());
            throw new \Exception('Connection Error');
        }
    }
}
