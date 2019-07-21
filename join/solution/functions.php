<?php
session_start();

$login = strip_tags($_POST['login']);
$password = strip_tags($_POST['password']);

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sbeketov');
define('DB_USER', 'sbeketov');
define('DB_PASSWORD', 'neto1800');

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;

$db = new PDO($connect_str, DB_USER, DB_PASSWORD);

$sql = "SELECT * FROM user";
$users = $db->query($sql);

$reg = $db->prepare("INSERT INTO tasks (login, password) VALUES (:login, :password)");
$userSql = $db->prepare("SELECT * FROM tasks WHERE )");


function login($login, $password) //function login(string $login, string $password): bool
{
  $user = getUser($login);
  if ($user && $user['password'] == $password) {
    $_SESSION['user'] = $user;
    return true;
  }
  return false;
}

function isGuest() {
  return empty($_SESSION); 
}

function getUsers() //function getUsers(): array
{
  $fileData = file_get_contents('users.json'); //(__DIR__ . '/data/users.json'
  $users = json_decode($fileData, true);  
  if (!$users) {
    return [];  
  } 
  return $users;
}


// ?array в PHP 7. Возвращается либо массив, либо null
function getUser($login) { //function getUser($login): ?array {
  $users = 
  foreach ($users as $user) {
    if($user['login'] == $login) {
       return $user;
    }
  }
  return null;
}