<?php

namespace System;

class Database
{
    /** @var  \PDO */
    private $pdo;

    /** @var  \PDOStatement */
    private $statement;

    public function __construct()
    {
        $config = include CONFIG_PATH . '/database.php';
        $dsn = $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'];
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        ];
        $this->pdo = new \PDO($dsn, $config['username'], $config['password'], $options);
    }

    public function select($sql, array $data = [])
    {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($data);

        return $this->statement->fetchAll();
    }

    public function delete($sql, array $data = [])
    {
        return $this->query($sql, $data);
    }

    public function lastInsertId($sql, array $data = [])
    {
        $this->query($sql, $data);
        return $this->pdo->lastInsertId();
    }

    public function insert($sql, array $data = [])
    {
        return $this->query($sql, $data);
    }

    public function update($sql, array $data = [])
    {
        return $this->query($sql, $data);
    }

    public function query($sql, array $data = [])
    {
        $this->statement = $this->pdo->prepare($sql);
        return $this->statement->execute($data);
    }
}