<?php
$list = scandir('tests');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Список тестов</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
  <h3>Список тестов</h3>
  <ol>
  	<?php 
  	foreach ($list as $test) { 
  		if (substr($test, -5) == '.json') { ?>
    
    <li><?php echo $test; ?></li>
    
    <?php }
	} ?>
  </ol>

  <form action="test.php" method="GET">
  	<div>Введите номер теста</div>
  	<div><input type="text" name="test_number"> </div>
  	<input type="submit" value="Пройти тест">
  </form>

  <a href="admin.php">Загрузить файл с тестом</a>

</body>
</html>