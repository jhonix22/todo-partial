<?php

namespace Todo\Partial\Model;

use SQLiteConnection;

class TodoList implements InterfaceTodoList
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
     * Return the current list of TODO items
     *
     * @param array $config Allow the Todo items to be ordered and filtered
     *
     * @return array
     */
    public function getAll($config = [])
    {

    }

    /**
     * Add a Todo item to the list
     *
     * @param InterfaceTodo $todo
     */
    public function add(InterfaceTodo $todo)
    {
        
    }

    /**
     * Remove a Todo item from the list
     *
     * @param int $id
     */
    public function remove($id)
    {

    }
}
