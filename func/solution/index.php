<?php
date_default_timezone_set('Europe/Moscow');

$link = 'http://api.openweathermap.org/data/2.5/weather';
$id = 480562;
$units = 'metric';
$lang = 'ru';
$apiKey = 'fa7acac69c76d840f061f2e3ea8108d2';
$url = "{$link}?id={$id}&units={$units}&lang={$lang}&appid={$apiKey}";
$data = file_get_contents($url);

if ($data) {
  
  $dataJson = json_decode($data) or exit('Ошибка декодирования json');
  
  function checkParameter($parameter) { 
    $parameter = (!empty($parameter)) ? $parameter : 'не удалось получить данные' ;
    return $parameter;
    }

  $dt = date("H:i j.m", $dataJson->dt);//Дата
  $temp = checkParameter(round($dataJson->main->temp)); //температура Цельсий
  $pressure = checkParameter($dataJson->main->pressure);//давление hpa 
  $humidity = checkParameter($dataJson->main->humidity);//влажность %
  $windSpeed = checkParameter(round ($dataJson->wind->speed, 1));//скорость ветра м/с
  
  foreach ($dataJson->weather as $item) {
    $description = checkParameter($item->description);
    $icon = $item->icon;      
  }

} else {
  exit('Сервер не доступен');

}
?>

<!DOCTYPE html>
<html lang = "ru">
<head>
  <meta charset="utf-8">
  <title>Погода в Туле</title>
  <link rel="stylesheet" href="style.css" type="text/css" />  
</head>

<body>
  <div class="wrap">
    <h1 class="city">Погода в Туле</h1>

    <div class="main clearfix">
      <img class="icon" src=<?php echo "http://openweathermap.org/img/w/$icon.png" ?>>
      <p class="temp"><?php echo $temp ?> &degС</p>
    </div>

    <div class="description">
      <p><?php echo $description ?> <time><?php echo $dt ?></time></p>
    </div> 

    <table class="parametrs">
      <tr>
        <td>Давление</td>
        <td><?php echo $pressure ?> гПа</td>
      </tr>
      <tr>
        <td>Влажность</td>
        <td><?php echo $humidity ?> %</td>
      </tr>
      <tr>
        <td>Скорость ветра</td>
        <td><?php echo $windSpeed ?> метр/сек</td>
      </tr>
    </table>
  </div>
</body>
</html>