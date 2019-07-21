<?php

$id = strip_tags($_GET['id']);
$action = strip_tags($_GET['action']);

$description = strip_tags($_POST['description']);
$date = date ('Y-m-d G:i:s');
$submit = 'Добавить';
$edit = false;

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;

$db1 = new PDO($connect_str, DB_USER, DB_PASSWORD);


$delete = $db1->prepare("DELETE FROM tasks WHERE id=:id ");
$update = $db1->prepare("UPDATE tasks SET is_done = 1 WHERE id = :id");
$insert = $db1->prepare("INSERT INTO tasks (description, date_added) VALUES (:description, :date_added)");

if(!empty($action)) {
	
	if($action == 'delete') {
		$delete->bindValue(':id', $id);
		$delete->execute();
	} else if ($action == 'done') {
		$update->bindValue(':id', $id);
		$update->execute();
	} else if ($action == 'edit') {
		$submit = 'Сохранить';
		$edit=true;
	}
}

if(!empty($description)) {
	if($edit==true){
		$db1->exec("UPDATE tasks SET description = '$description' WHERE id = '$id'");
	}
	$insert->bindParam(':description', $description);
	$insert->bindParam(':date_added', $date);
	$insert->execute();
}
$sql = "SELECT * FROM tasks";

function Done($is_done) {
	if ($is_done == 1) {
		echo $done = 'Выполнено';
	} elseif ($is_done == 0) {
		echo $done = 'В процессе';
	}
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
	<title>Домашнее задание к лекции 4.2 «Запросы SELECT, INSERT, UPDATE и DELETE»</title>
</head>
<body>
<h1>Список дел на сегодня</h1>

<form action="lesson.php" method="POST">
	<input type="text" name="description" placeholder="Описание задачи">
	<input type="submit" value="<?php echo $submit ?>">
</form>

<table class="tasks">
	<thead>
	  <tr>
		<td>Описание задачи</td>
		<td>Дата добавления</td>
		<td>Статус</td>
		<td></td>
	  </tr>
	</thead>
	<tbody>
	  <?php foreach ($db1->query($sql) as $task) { ?>
	  <tr>
		<td><?php echo $task['description'] ?></td>
		<td><?php echo $task['date_added'] ?></td>
		<td><?php Done($task['is_done']) ?></td>
		<td>
			<a href="<?php echo '?id=' . $task['id'] . '&action=edit' ?>">Изменить</a>
			<a href="<?php echo '?id=' . $task['id'] . '&action=done' ?>">Выполнить</a>
			<a href="<?php echo '?id=' . $task['id'] . '&action=delete' ?>">Удалить</a>
		</td>
	  </tr>
	</tbody>
<?php } ?>
</tbody>
</table>

</body>
</html>