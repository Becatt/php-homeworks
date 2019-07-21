<?php 
session_start();
//require_once __DIR__ . '/functions.php';
if (empty($_SESSION)) {
  header('Location: login.php');
}
  die;
} 

?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Админка</title>
</head>
<body> 

 Привет, <?php echo $_SESSION['user']['login'] ?><br/>
 <ul>
   <li><a href="logout.php">выход</a></li>  
   <li><a href="only_admins.php">только для админов</a></li>  
 </ul>  
</body>
</html>