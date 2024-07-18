<?php

class Database
{
    public $connection;
    public $statement;

    /**
     * Constructor for Database class.
     *
     * @param array $config Configuration array for the database connection.
     * @param string $username Username for the database connection.
     * @param string $password Password for the database connection.
     * @throws PDOException If connection to the database fails.
     */
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            $this->statement->closeCursor();
            throw new Exception('Record not found');
        }

        return $result;
    }
}