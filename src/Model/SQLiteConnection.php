<?php

namespace Todo\Partial\Model;

/**
 * SQLite connnection
 */
class SQLiteConnection
{
    /**
     * PDO instance
     * @var type 
     */
    private $pdo;
 
    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect() 
    {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
            } catch (\PDOException $e) {
                // throw exception
                echo 'Connection failed: ' . $e->getMessage();
                exit;
            }
        }
        return $this->pdo;
    }

    /**
     * Create todo_list table
     */
    
    public function createTable($pdo)
    {
        // check pdo object if not null
        if ($pdo != null)
        {
            $stmt = $pdo->query("CREATE TABLE IF NOT EXISTS todo_list (
                id              INTEGER       PRIMARY KEY AUTOINCREMENT,
                TodoDescription VARCHAR (255) NOT NULL,
                CompletedStatus INTEGER (1)   DEFAULT (0),
                date_added      DATETIME
            );
        ");
            return $stmt->execute();
        }
    }
}