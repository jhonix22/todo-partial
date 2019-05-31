<?php

namespace Todo\Partial\Model;


class Todo implements InterfaceTodo
{
    /**
     * @var description
     * @var status
     */
    protected $description;
    protected $status;
    protected $id;

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
        $this->status = 1;
    }

    /**
     * Remove the completed status
     */
    public function removeCompletedStatus()
    {
        $this->status = 0;
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
