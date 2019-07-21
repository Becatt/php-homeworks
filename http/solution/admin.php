<!DOCTYPE html>
<html>
<head>
	<title>Загрузка файла</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
  <form enctype="multipart/form-data" action="loader.php" method="POST">
  	<div>Загрузить тест</div>
  	<div><input type="file" name="test"></div>
  	<input type="submit" value="Отправить">
  </form>


<a href="list.php">Перейти к списку тестов</a>

</body>
</html>