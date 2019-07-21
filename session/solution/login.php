<?php 
require_once __DIR__ . '/functions.php';
if (!isGuest()) {
  header('Location: index.php');
}
$errors = [];
if(!empty($_POST)) {
    //проверка на корректность логина и пароля
    if(login($_POST['login'], $_POST['password'])) {
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
        <h1>Авторизация</h1>
        <ul>  
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach ; ?>
        </ul>
        <form method="POST">
          <div class="form-group">
            <label for="lg" >Логин</label>
            <input type="text" placeholder="Логин" name="login" id="lg" >
          </div>
          <div class="form-group">
            <label for="key">Пароль</label>
            <input type="password" placeholder="Пароль" name="password" id="key">
          </div>  
          <input type="submit" id="btn-login" value="Войти">
          <hr>
        </form>
      </div>
    </div>
  </section> 
</body>
</html>