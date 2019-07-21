<?php 

session_start();

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sbeketov');
define('DB_USER', 'sbeketov');
define('DB_PASSWORD', 'neto1800');


if(!empty($_POST)) {
$login = strip_tags($_POST['login']);
$password = strip_tags($_POST['password']);
}

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;

$db = new PDO($connect_str, DB_USER, DB_PASSWORD);

$reg = $db->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
$userSql = $db->prepare("SELECT * FROM user WHERE login=?");
$userSql->execute([$login]);
$user = $userSql->fetch();

  if ($user['password'] == $password) {
    $_SESSION['user'] = $user;
  }
// ?array в PHP 7. Возвращается либо массив, либо null


/*require_once __DIR__ . '/functions.php';
if (!isGuest()) {
  header('Location: index.php');
}
*/
if (!empty($_SESSION)) {
  header('Location: index.php');
}

$errors = [];
if(!empty($_POST)) {
    //проверка на корректность логина и пароля
    if($user['password'] == $password) {
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
          <!--<label for="lg" >Логин</label>-->
          <input type="text" placeholder="Логин" name="login">
          <!--<label for="key">Пароль</label>-->
          <input type="password" placeholder="Пароль" name="password">
          <input type="submit" id="btn-login" value="Войти">
          <input type="submit" id="btn-reg" value="Регистрация">
        </form>
      </div>
    </div>
  </section> 
</body>
</html>