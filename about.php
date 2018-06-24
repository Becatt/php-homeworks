<?php 
$name = 'Сергей';
$age = 31;
$email = 'beketov.serg@gmail.com';
$city = 'Тула';
$about = 'Студент Нетологии';
?>

<!DOCTYPE HTML>
<html lang="ru">
  <head>
  	<meta charset="utf-8">
  	<title><?= $name . '-' . $about ?></title>
  </head>

  <body>
  	<h1>Данные пользователя <?= $name ?></h1>

  	<table>
  	  <tr>	
        <td>Имя</td>
        <td><?= $name ?></td>
      </tr>
      <tr>
        <td>Возраст</td>
        <td><?= $age ?></td>
      </tr>
      <tr>
        <td>Адрес электорнной потчы</td>
        <td><a href="mailto:<?= $email ?>"><?= $email ?></a></td>
      </tr>
      <tr>
       <td>Город</td>
       <td><?= $city ?></td>
      </tr>
      <tr>
        <td>О себе</td>
        <td><?= $about ?></td>
      </tr>
    </table>
  </body>
</html>