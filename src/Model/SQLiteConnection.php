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
                $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (\PDOException $e) {
                // throw exception
                echo 'Connection failed: ' . $e->getMessage();
                exit;
            }
        }
        return $this->pdo;
    }
}