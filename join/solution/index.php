<?php
session_start();
if (empty($_SESSION)) {
  echo '<a href="register.php">Войдите на сайт</a>'; 
  die;
} 

if (!empty($_GET)) {
	$id = strip_tags($_GET['id']);
	$action = strip_tags($_GET['action']);
}

$date = date ('Y-m-d G:i:s');
$user_id = $_SESSION['user']['id'];
$user_login = $_SESSION['user']['login'];

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sbeketov');
define('DB_USER', 'sbeketov');
define('DB_PASSWORD', 'neto1800');

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;

$db = new PDO($connect_str, DB_USER, DB_PASSWORD);

$insert = $db->prepare("INSERT INTO task (description, date_added, user_id) VALUES (:description, :date_added, :user_id)");
$delete = $db->prepare("DELETE FROM task WHERE id=:id ");
$update = $db->prepare("UPDATE task SET is_done = 1 WHERE id = :id");
$updateUser = $db->prepare("UPDATE task SET assigned_user_id = :assigned_user_id WHERE id = :id");
$selectUsers = $db->prepare("SELECT id, login FROM user WHERE login != ?");
$selectTasks = $db->prepare("SELECT task.id task_id, task.description, task.date_added date, task.is_done, user.id, user.login 
							 FROM task 
							 LEFT JOIN user ON user.id = task.assigned_user_id
							 WHERE task.user_id=? ");
$selectMyTasks = $db->prepare("SELECT task.id task_id, task.description, task.date_added date, task.is_done, user.id, user.login 
							 FROM task 
							 LEFT JOIN user ON user.id = task.user_id
							 WHERE task.assigned_user_id=? ");


if(!empty($_POST['description'])) {
	$description = strip_tags($_POST['description']);
	$insert->bindParam(':description', $description);
	$insert->bindParam(':date_added', $date);
	$insert->bindParam(':user_id', $user_id);
	$insert->execute();
}

if(!empty($action)) {
	
	if($action == 'delete') {
		$delete->bindValue(':id', $id);
		$delete->execute();
	} else if ($action == 'done') {
		$update->bindValue(':id', $id);
		$update->execute();
	}
}

if(!empty($_POST['assigned_user_id'])){
	$assigned = $_POST['assigned_user_id'];
	if(preg_match_all('/\_([0-9]+)/', $assigned, $match)){
		$assigned_user_id = $match[1][0];
		$assigned_task_id = $match[1][1];
	}
	$updateUser->bindValue(':assigned_user_id', $assigned_user_id);
	$updateUser->bindValue(':id', $assigned_task_id);
	$updateUser->execute();
}

$selectUsers->execute(array($user_login));
$users = $selectUsers->fetchAll();

$selectTasks->execute(array($user_id));
$tasks = $selectTasks->fetchAll();

$selectMyTasks->execute(array($user_id));
$myTasks = $selectMyTasks->fetchAll();

function Done($is_done) {
	if ($is_done == 1) {
		echo 'Выполнено';	
	} elseif ($is_done == 0) {
		echo 'В процессе';
	}
}

function Login($login) {
	if (empty($login)) {
		echo 'Вы';	
	} else {
		echo $login;
	}
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
	<title>Домашнее задание к лекции 4.2 «SELECT из нескольких таблиц»</title>
</head>
<body>
<h1>Привет, <?php echo $user_login ?>! Вот ваш список дел:</h1>

<form method="POST">
	<input type="text" name="description" placeholder="Описание задачи">
	<input type="submit" value="Добавить">
</form>

<table class="tasks">
	<thead>
	  <tr>
		<td>Описание задачи</td>
		<td>Дата добавления</td>
		<td>Статус</td>
		<td></td>
		<td>Ответственный</td>
		<td>Автор</td>
		<td>Закрепить задачу за пользователем</td>
	  </tr>
	</thead>
	<tbody>
	  <?php foreach ($tasks as $task) { ?>
	  <tr>
		<td><?php echo $task['description'] ?></td>
		<td><?php echo $task['date'] ?></td>
		<td><?php Done($task['is_done']) ?></td>
		<td>
			<a href="<?php echo '?id=' . $task['task_id'] . '&action=done' ?>">Выполнить</a>
			<a href="<?php echo '?id=' . $task['task_id'] . '&action=delete' ?>">Удалить</a>
		</td>
		<td><?php Login($task['login']) ?></td>
		<td><?php echo $user_login ?></td>
		<td><form method="POST">
			  <select name="assigned_user_id">
				<?php foreach($users as $user) {?>
				  <option value="<?php echo 'user_' . $user['id'] . '_task_' . $task['task_id']?>"><?php echo $user['login'] ?></option>
				<?php } ?>
			  </select>
			  <input type="submit" name="assign" value="Переложить ответственность">
			</form>
		</td>
	  </tr>
	  <?php } ?>
	</tbody>
</table>

<h3>Также, посмотрите, что от Вас требуют другие люди:</h3>

<table class="tasks">
	<thead>
	  <tr>
		<td>Описание задачи</td>
		<td>Дата добавления</td>
		<td>Статус</td>
		<td></td>
		<td>Ответственный</td>
		<td>Автор</td>
	  </tr>
	</thead>
	<tbody>
	  <?php foreach ($myTasks as $task) { ?>
	  <tr>
		<td><?php echo $task['description'] ?></td>
		<td><?php echo $task['date'] ?></td>
		<td><?php Done($task['is_done']) ?></td>
		<td>
			<a href="<?php echo '?id=' . $task['task_id'] . '&action=done' ?>">Выполнить</a>
			<a href="<?php echo '?id=' . $task['task_id'] . '&action=delete' ?>">Удалить</a>
		</td>
		<td><?php echo $user_login ?></td>
		<td><?php echo $task['login'] ?></td>
	  </tr>
	  <?php } ?>
	</tbody>
</table>

<a href="logout.php">выход</a> 

</body>
</html>