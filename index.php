<?php
require_once('function.php');

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $name = htmlspecialchars($name, ENT_QUOTES);

  $dbh = db_connect();

    
  $sql = 'INSERT INTO tasks (name, done) VALUES (?, 0)';
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(1, $name, PDO::PARAM_STR);

  $stmt->execute();

  $dbh = null;

  unset($name);


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDoリスト</title>
</head>
<body>
<h1>ToDoリスト</h1>
  <form action="index.php" method="post">

    <ul>
      <li>
      <span>タスク名</span><input type="text" name="name">
      </li>
      <li>
      <input type="submit" name="submit">
      </li>
    </ul>

  </form>
</body>
</html>