<?php

/* Enable autoloading */
require_once __DIR__ . '/../vendor/autoload.php';

/* Begin Application */
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
      <input class="rounded bg-light col-8 my-4 p-2" id="new-item" autocomplete="off" placeholder="Enter list...">
      <button type="submit" class="btn btn-dark ml-4"> + </button>
    </form>

    <div>
      <ol class="list-group" id="items-list">
      </ol>
    </div>
  </div>
</body>
</html>
