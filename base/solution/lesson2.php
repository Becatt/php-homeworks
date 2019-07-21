<!DOCTYPE HTML>
<html lang="ru">

  <head>
    <title>Основы php</title>
  </head>

  <body>
    <form method= "GET" action="lesson2.php">
      Введите число
      <input name="x" type="number">
      <input type="submit" value= "Ок">
    </form>
  </body>
</html>

<?php
  $x = $_GET['x'];
  $a = 1;
  $b = 1;

  if ($x !== NULL) {

    while(true){
      
      if ($a > $x) {  
        echo "Число " . $x ." НЕ входит в числовой ряд";
        break;
        
      } elseif($a == $x) {
         echo "Число " . $x ." входит в числовой ряд";
         break;
        
      } else {
          $c = $a;
          $a = $a + $b;
          $b = $c;
          echo $a . " " . $b . " " . $c . "<br>";
      }
    }
  }
?>


