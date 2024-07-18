<?php
namespace Core;
use Core\Database;
class Model {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Helper function to fetch all results of a query
     *
     * @param string $query The query to execute
     * @param array<string, mixed> $params An associative array of parameters for the query
     * @return array<object>|null The array of results of the query, or null if no results were found
     */
    public function getAll(string $query, array $params = []): ?array {
        $this->db->query($query);
        foreach ($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        return $this->db->resultSet();
    }

    /**
     * Helper function to fetch a single result of a query
     *
     * @param string $query The query to execute
     * @param array<string, mixed> $params An associative array of parameters for the query
     * @return object|null The single result of the query, or null if no result was found
     */
    public function getSingle(string $query, array $params = []): ?object {
        $this->db->query($query);
        foreach ($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        return $this->db->single();
    }

    /**
     * Helper function to execute a query
     *
     * @param string $query The query to execute
     * @param array<string, mixed> $params An associative array of parameters for the query
     * @return bool True if the query was executed successfully, false otherwise
     */
    public function executeQuery(string $query, array $params = []): bool {
        $this->db->query($query);
        foreach ($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        return $this->db->execute();
    }

    /**
     * Helper function to get the row count of a query
     *
     * @param string $query The query to get the row count for
     * @param array $params An associative array of parameters for the query
     * @return int The row count of the query
     */
    public function getRowCount(string $query, array $params = []): int {
        $this->db->query($query);
        foreach ($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        return $this->db->rowCount();
    }
}
