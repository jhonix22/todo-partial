<?php

namespace Todo\Partial\Model;

use SQLiteConnection;
use Todo\Partial\Model\Todo;

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
     * @return array of todo list
     */
    public function getAll($config = [])
    {  
        //sanitize data
        $filter_by = strip_tags(htmlentities($config['filter_by']));
        $filter_value = strip_tags(htmlentities($config['filter_value']));
        $sort_id = strip_tags(htmlentities($config['sort_id']));
        $sort_by = strip_tags(htmlentities($config['sort_by']));


        // SQL query
        $sqlQuery ='SELECT * FROM todo_list 
                    WHERE 
                        ' .$filter_by. ' like "%' .$filter_value. '"
                    ORDER BY
                        ' .$sort_id. ' ' .$sort_by. '
                    ';

        //  prepare SELECT statement
        $stmt = $this->pdo->prepare($sqlQuery);
    
        $stmt->execute();

        // for storing list
        $list = [];
 
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $todo = new Todo();
            $todo->setTodoId($row['id']);
            $todo->setTodoDescription($row['TodoDescription']);

            $list[] = $todo;
        }
 
        return $list;
    }

    /**
     * Add a Todo item to the list
     *
     * @param InterfaceTodo $todo
     */
    public function add(InterfaceTodo $todo)
    {
        $sql = 'INSERT INTO todo_list(TodoDescription) VALUES(:description)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['description' => $todo->getTodoDescription()]);
    }

    /**
     * Remove a Todo item from the list
     *
     * @param int $id
     * @return boolean
     */
    public function remove($id)
    {
        // prepare DELETE statement
        $stmt = $this->pdo->prepare("DELETE FROM todo_list WHERE id =:id");
        $stmt->execute(array("id" => $id));

        return $stmt->rowCount() > 0 ? true : false;
    }
}
