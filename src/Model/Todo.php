<?php

namespace Todo\Partial\Model;


class Todo implements InterfaceTodo
{
    /**
     * @var description
     * @var status
     * @var \PDO
     */
    protected $description;
    protected $id;
    protected $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Get the current Todo item description
     *
     * @return string
     */
    public function getTodoDescription()
    {
        return $this->description;
    }

    /**
     * Set the Todo item description
     *
     * @param string $value
     */
    public function setTodoDescription($value)
    {
        $this->description = $value;
    }

    /**
     * Mark the Todo item as completed
     */
    public function setCompletedStatus()
    {
        $sql = 'UPDATE todo_list SET CompletedStatus=:status WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['status' => 1, 'id' => $this->getTodoId()]);
    }

    /**
     * Remove the completed status
     */
    public function removeCompletedStatus()
    {
        $sql = 'UPDATE todo_list SET CompletedStatus=:status WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['status' => 0, 'id' => $this->getTodoId()]);
    }

    /**
     * Get completed status
     */

    public function getCompletedStatus()
    {
        $sql = 'SELECT CompletedStatus FROM todo_list WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $this->getTodoId()]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['CompletedStatus'];
    }
    /**
     * Set the Todo item id
     */
    public function setTodoId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the Todo item id
     */
    public function getTodoId()
    {
        return $this->id;
    }

}
