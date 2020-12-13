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
      
      <span>タスク　</span><input type="text" name="name">

      <input type="submit" name="submit">
      
    </ul>

  </form>
  <ul>
  <?php
  $dbh = db_connect();

$sql = 'SELECT id, name FROM tasks ORDER BY id DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;

while($task = $stmt->fetch(PDO::FETCH_ASSOC)){

  print '<input type="checkbox" name="done">';
  print $task["name"];

  print '
          <form action="index.php" method="post">
          <input type="hidden" name="method" value="put">

<input type="hidden" name="id" value="' . $task['id'] . '">
          <button type="submit">Done</button>
          </form>
        ' ;

}

  ?>
</ul>
</body>
</html>