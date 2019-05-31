<?php

namespace Todo\Partial\Model;

interface InterfaceTodo
{
    /**
     * Get the current Todo item description
     *
     * @return string
     */
    public function getTodoDescription();

    /**
     * Set the Todo item description
     *
     * @param string $value
     */
    public function setTodoDescription($value);

    /**
     * Mark the Todo item as completed
     */
    public function setCompletedStatus();

    /**
     * Remove the completed status
     */
    public function removeCompletedStatus();

    /**
     * Set the Todo item id
     */
    public function setTodoId($id);
    
    /**
     * Get the current Todo item Id
     */
    public function getTodoId();
}
