<?php 

session_start();

$errors = [];

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sbeketov');
define('DB_USER', 'sbeketov');
define('DB_PASSWORD', 'neto1800');

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;

$db = new PDO($connect_str, DB_USER, DB_PASSWORD);

$reg = $db->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
$userSql = $db->prepare("SELECT * FROM user WHERE login=?");

if (!empty($_POST)){
  $login = strip_tags($_POST['login']);
  $password = strip_tags($_POST['password']);

  $userSql->execute([$login]);
  $user = $userSql->fetch();

  if(!empty($_POST['reg'])){
    if($login==$user['login']){
      $errors[] = 'Пользователь ' . $login . ' уже существует';
    } else {
      $reg->bindParam(':login', $login);
      $reg->bindParam(':password', $password);
      $reg->execute();
    }
  }
  
  
  if(!empty($user) && $user['password'] == $password){
    $_SESSION['user'] = $user;
  }

  if (!empty($_SESSION)) {
    header('Location: index.php');
  } else {
    $errors[] = 'Неверный логин или пароль';
  }
}

?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
</head>
<body>  
  <section id="login">
    <div class="container">
      <div class="form-wrap">
        <h3>Введите данные для регистрации или войдите, если уже регистрировались:</h3>
        <ul>  
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach ; ?>
        </ul>
        <form method="POST">
          <input type="text" placeholder="Логин" name="login" required>
          <input type="password" placeholder="Пароль" name="password" required>
          <input type="submit" name="autoriz" value="Войти">
          <input type="submit" name="reg" value="Регистрация">
        </form>
      </div>
    </div>
  </section> 
</body>
</html>