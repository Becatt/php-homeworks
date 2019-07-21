<?php

$jsonPhone = file_get_contents("phone.json");

$conacts = json_decode($jsonPhone, true) or exit('Ошибка декодирования json');

function checkParameter ($parameter, $key) {  
    $parameter = (!empty($parameter)) ? $parameter : null;
    if ($parameter == null) {
      return $parameter;
    } else {
      switch ($key) {
        case "city":
            $parameter = "г. " . $parameter;
            break;
        case 'streetAdress':
            $parameter = ",  ул. " . $parameter;
            break;
        case 'house':
             $parameter = ",  д. " . $parameter;
            break;
        case "apt":
             $parameter = ",  кв. " . $parameter;
            break;
        case "personal":
            $parameter = "личный: " . $parameter . "</br>";
            break;
        case "worker":
            $parameter = "рабочий: " . $parameter . "</br>";
            break;
        case "home":
            $parameter = "домашний: " . $parameter;
            break;
      }
    }
    return $parameter;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Домашнее здание к лекции "Установка и настройка веб-сервера"</title>
  <style type="text/css">
    table{
      border-spacing: 0;
      border-collapse: collapse;
    }
    table td {
      border: solid 1px #222;
      padding: 5px;
    }
  </style>
</head>
<body>
  <table>
  	<thead>
  	  <tr>
  	  	<td>Контакт</td>
  	  	<td>Телефон</td>
  		<td>Адрес</td>
  	  </tr>
  	</thead>
  	<tbody>
  	  <?php foreach ($conacts as $item) { ?>
  	  	<tr>
  	  	  <td><?php echo $item['firstName'] . " " . $item['lastName'] ?></td>
  	  	  <td><?php echo checkParameter($item ['phoneNumbers'] ['personal'], 'personal') . checkParameter($item['phoneNumbers'] ['worker'], 'worker'), checkParameter($item ['phoneNumbers'] ['home'], 'home') ; ?></td>
  	  	  <td><?php echo checkParameter($item ['address'] ['city'], 'city') . checkParameter($item['address'] ['streetAdress'], 'streetAdress') . checkParameter($item ['address'] ['house'], 'house') . checkParameter($item ['address'] ['apt'], 'apt') ; ?></td>
  	  	</tr>
  	  <?php  }?>
  	</tbody>
  </table>  

</body>
</html>