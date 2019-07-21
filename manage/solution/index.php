<?php
require_once(__DIR__ . '/functions.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" type="text/css" />
	<title>Домашнее задание к лекции 4.4 «Управление таблицами и базами данных»</title>
</head>
<body>

<h1>Упралвение таблицами и базами данных</h1>
<h2>Создание новой таблицы</h2>
<ul>  
    <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach ; ?>
</ul>

<form method="POST">
	<input type="text" name="tabName" placeholder="Название таблицы">
	<input type="submit" value="Создать">
</form>

<table class="tables">
	<thead>
	  <tr>
		<td>Список таблиц</td>
	  </tr>
	</thead>
	<tbody>
	  <?php foreach ($tables as $nameTable) { ?>
	  <tr>
		<td><a href="<?php echo '?table=' . $nameTable['Tables_in_sbeketov'] ?>"><?php echo $nameTable['Tables_in_sbeketov'] ?></td>
	  </tr>
	  <?php } ?>
	</tbody>
</table>

<h2>Информация о таблице <?php echo $table ?> (просьба поля в таблицах: books, task, tasks и user не редактировать)</h2>
<table class="tables">
	<thead>
	  <tr>
		<?php foreach ($fields as $key=>$field) { ?>
			<td><?php echo $key ?></td>
	  	<?php } ?>
	  </tr>
	</thead>
	<tbody>
	  <?php foreach ($tableDescript as $field) { ?>
	  <tr>	
			<?php foreach ($field as $param) { ?>
			<td><?php echo $param ?></td>
	  	<?php } ?>
	  	<td>
	  		<form method="POST" action="<?php echo 'index.php?table=' . $table . '&column=' . $field['Field'] . '&type=' . $field['Type'] . '&null=' . $field['Null'] . '&default=' . $field['Default'] . '&extra=' . $field['Extra'] ?>">
	  			<input type="submit" name="delete" value="Удалить поле">
	  			<input type="submit" name="update" value="Изменить поле">
	  			<select name="new_type">
	  				<option disabled selected>Выберите тип</option>
	  				<option value="INT">INT</option>
	  				<option value="VARCHAR(150)">VARCHAR(150)</option>
	  			</select>
	  			<input type="text" name="new_name" placeholder="Новое название">
	  		</form>
	  	</td>
	  </tr>
	  <?php } ?>	  
	</tbody>

</table>

</body>
</html>