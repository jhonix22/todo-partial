<?php

/* Enable autoloading */
require_once __DIR__ . '/../vendor/autoload.php';

use Todo\Partial\Model\TodoList;
use Todo\Partial\Model\SQLiteConnection;
use Todo\Partial\Model\Todo;

//Initialize objects;
$pdo = (new SQLiteConnection())->connect();
$todo = new TodoList($pdo);

//set initial filters
$filters = array("filter_by" => "TodoDescription", "filter_value" => "","sort_id" => "id" , "sort_by" => "asc");

/**
 * Initialize variables
 */
$filter_value = "";
$sort_id = "id"; //default to id column
$sort_by = "asc"; //default order ascending

//store returned todo list
$lists = $todo->getAll($filters);

/**
 * PROCESS POST REQUEST HERE
 */

//add todo list
if (!empty($_POST["add"]) && !empty($_POST['description'])) {

    /**
     * Initialize todo object
     */
    
    $todoAction = new Todo();
    
    //sanitize
    $description = strip_tags(htmlentities($_POST['description']));

    /**
     * SET completed status and description
     */
    $todoAction->setTodoDescription($description);

    /** 
     * Add todo item to our list
     */
    $todo->add($todoAction);
    header('Location: '.$_SERVER['REQUEST_URI']);
}

//remove list item
if (isset($_POST['action']) && $_POST['action'] == 'remove') {
    //sanitize
    $id = strip_tags(htmlentities($_POST['id']));
    if ($todo->remove($id)) {
        echo json_encode(array("success" => 1));
        return;
    }
}

//set status of item
if (isset($_POST['action']) && $_POST['action'] == 'set_status') {
    
    //sanitize
    $id = strip_tags(htmlentities($_POST['id']));
    $status = strip_tags(htmlentities($_POST['status']));

    $todo = new Todo($pdo);
    $todo->setTodoId($id);

    if ($status == 'complete') {
        $todo->setCompletedStatus();
    }else{
        $todo->removeCompletedStatus();
    }

    echo json_encode(array("success" => 1));
    return;
}

//search by
if (!empty($_POST['filter'])) {

    //sanitize
    $filter_value = strip_tags(htmlentities($_POST['filter_value']));
    $filters = array("filter_by" => "TodoDescription", "filter_value" => $filter_value,"sort_id" => "id" , "sort_by" => "asc");
    $lists = $todo->getAll($filters);
}

//order by
if (!empty($_POST['order'])) {

    //sanitize
    $sort_by = strip_tags(htmlentities($_POST['sort_by']));
    $sort_id = strip_tags(htmlentities($_POST['sort_id']));
    $filters = array("filter_by" => "TodoDescription", "filter_value" => "","sort_id" => $sort_id , "sort_by" => $sort_by);
    $lists = $todo->getAll($filters);
}

/**
 * END OF POST PROCESSING
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
<header class="bg-info text-center text-white p-4 mb-3">
    <h2>To-do List</h2>
  </header>

  <div class="container bg-secondary pl-5">
    <form id="add-list" method="POST" action="">
      <div class="form-group">
        <input class="rounded bg-light col-8 my-4 p-2" name="description" id="new-item" autocomplete="off" placeholder="Enter list...">
        <input type="submit" class="btn btn-dark ml-4" name="add" value="Add">
      </div>
        <div style="display:flex;">
            <div class="form-group col-md-4" style="padding-left:0px;">
                <input type="text" placeholder="Search" name="filter_value" value="<?php echo $filter_value ;?>" class="rounded bg-light col-8 my-4 p-2"><br/>
                <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                <input type="button" class="btn btn-default" value="Reset" name="Reset" onclick="window.location.href=''">
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="sort_id" class="label label-default"><b>Order By</b></label>
                    <select name="sort_id" id="sort_id" class="form-control col-md-4">
                        <option value="id" <?php echo $sort_id == 'id' ? "selected" : "";?>>ID</option>
                        <option value="TodoDescription" <?php echo $sort_id == 'TodoDescription' ? "selected" : "";?>>Description</option>
                    </select>
                    <input type="radio" class="checkbox" value="asc" <?php echo $sort_by == "asc" ? "checked" : "";?> name="sort_by"> ASC
                    <input type="radio" class="checkbox" value="desc" <?php echo $sort_by == "desc" ? "checked" : "";?> name="sort_by"> DESC
                </div>
                <div class="form-group">
                    <input type="submit" value="Order" name="order" class="btn btn-primary">
                </div>
            </div>
        </div>
      <ol class="list-group" id="items-list">
        <?php
            foreach ($lists as $list) {
                ?>
                    <li class="list-group-item mb-2 w-75">
                        <input type="checkbox" name="completed" <?php echo $list->getCompletedStatus() ? 'checked' : '';?> value="1" alt="Toggle to set status" onchange="toggleStatus(this,<?php echo $list->getTodoId(); ?>)">
                        <input type="hidden" value="<?php echo $list->getTodoId(); ?>" name="todo_<?php echo $list->getTodoId(); ?>">
                        <?php echo strip_tags(htmlentities($list->getTodoDescription())); ?> 
                        <input type="button" value="Delete" onclick="removeItem(<?php echo $list->getTodoId(); ?>)" class="btn btn-sm btn-danger float-right mr-2">
                    </li>
                <?php
            }
        ?>
      </ol>
    </form>
  </div>
  <script>
    function toggleStatus(e,id){
       var status = "pending";
       if (e.checked) {
           status = "complete";
       }


            $.ajax({
                type: "POST",
                url: "/",
                data: {id: id, action: "set_status", status: status},
                success: function(data, status) {
                    data = JSON.parse(data);
                    if(data.success)
                        window.location.href = "/";
                }
            });
        
    }

    function removeItem(id){
        var x = confirm("Are you sure you want to remove this item?");
        
        if(!x) return false;

        $.ajax({
            type: "POST",
            url: "/",
            data: {id: id, action: "remove"},
            success: function(data) {
                data = JSON.parse(data);
                if(data.success)
                     window.location.href = "/";
            }
        });

    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
</body>
</html>
