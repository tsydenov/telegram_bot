<?php

namespace App;

/**
 * Database connection class
 */
class Database
{
    public function __construct(
        private string $driver,
        private string $host,
        private string $port,
        private string $name,
        private string $user,
        private string $password
    ) {
    }

    /**
     * Returns connection to database
     *
     * @return \PDO
     */
    public function connect(): \PDO
    {
        $conStr = sprintf(
            "%s:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $this->driver,
            $this->host,
            $this->port,
            $this->name,
            $this->user,
            $this->password
        );

        try {
            $conn = new \PDO($conStr);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }

        return $conn;
    }
}
