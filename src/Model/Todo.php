<?php

namespace Todo\Partial\Model;

use SQLiteConnection;

class Todo implements InterfaceTodo
{
    /**
     * PDO Object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Get the current Todo item description
     *
     * @return string
     */
    public function getTodoDescription()
    {

    }

    /**
     * Set the Todo item description
     *
     * @param string $value
     */
    public function setTodoDescription($value)
    {

    }

    /**
     * Mark the Todo item as completed
     */
    public function setCompletedStatus()
    {

    }

    /**
     * Remove the completed status
     */
    public function removeCompletedStatus()
    {

    }
}
