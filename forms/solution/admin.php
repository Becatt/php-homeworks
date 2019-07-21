<!DOCTYPE html>
<html>
<head>
	<title>Загрузка файла</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
  <form enctype="multipart/form-data" action="admin.php" method="POST">
  	<div>Загрузить тест</div>
  	<div><input type="file" name="test"></div>
  	<input type="submit" value="Отправить">
  </form>


<?php
if (!empty($_FILES)) {if ( $_FILES ['test']['error'] !== 0) {
		
		echo 'Файл не загружен, код ошибки: ' . $_FILES['test']['error'] . '<br>';

	} else if ($_FILES['test']['type'] !== 'application/json') {
		echo 'Неверный формат файла. Файл должен быть в формате JSON.<br>';

	} else {
		$list = scandir('tests');
		$updir = 'tests';
		$fname = count($list)-2  . "_тест.json";
		move_uploaded_file($_FILES['test'] ['tmp_name'], "$updir/$fname");
		$list = scandir('tests');
    
	    if (!empty (array_search($fname, $list))) {
			    echo 'Файл успешно загружен<br>';

	    } else {
	        echo 'Ошибка при загрузке файла<br>';
		}
	}
}

?>

<a href="list.php">Перейти к списку тестов</a>

</body>
</html>