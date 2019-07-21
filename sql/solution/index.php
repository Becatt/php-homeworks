<?php

if(empty($_GET)){
	$isbn = '';
	$name = '';
	$author = '';
} else {
	
	$isbn = $_GET['isbn'];
	$name = $_GET['name'];
	$author = $_GET['author'];
}

$action = "index.php?isbn=" . $isbn . "&name=" . $name . "&author=" . $author;

$pdo = new PDO("mysql:host=localhost; dbname=global", "sbeketov", "neto1800");
$pdo->exec('SET CHARACTER SET utf8');
$sql = "SELECT * FROM books WHERE isbn like '%$isbn%' and name like '%$name%' and author like '%$author%'";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
	<title>Домашнее задание к лекции"Реляционные базы данных и SQL"</title>
</head>
<body>
<h1>Библиотека успешного человека</h1>

<form action=<?php echo $action ?> method="GET">
	<input type="text" name="isbn" placeholder="ISBN" value=<?php echo $isbn ?>>
	<input type="text" name="name" placeholder="Название книги" value=<?php echo $name ?>>
	<input type="text" name="author" placeholder="Автор книги" value=<?php echo $author ?>>
	<input type="submit" value="Поиск">
</form>

<table class="books">
	<thead>
	  <tr>
		<td>Название</td>
		<td>Автор</td>
		<td>Год выпуска</td>
		<td>Жанр</td>
		<td>ISBN</td>
	  </tr>
	</thead>
	<tbody>
	  <?php foreach ($pdo->query($sql) as $book) { ?>
	  <tr>
		<td><?php echo $book['name'] ?></td>
		<td><?php echo $book['author'] ?></td>
		<td><?php echo $book['year'] ?></td>
		<td><?php echo $book['genre'] ?></td>
		<td><?php echo $book['isbn'] ?></td>
	  </tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>