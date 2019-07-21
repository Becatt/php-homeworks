<?php
require_once(__DIR__ . '/functions.php');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Домашнее задание к лекции 5.1 «Менеджер зависимостей Composer»</title>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        
        function init(){ 
            var myMap = new ymaps.Map("map", {
                center: [<?php echo $latitude?>, <?php echo $longitude ?>],
                zoom: 16
            }); 
            
            var myPlacemark = new ymaps.Placemark([<?php echo $latitude?>, <?php echo $longitude ?>], {
                hintContent: '<?php echo $address ?>',
                balloonContent: 'Содержимое балуна'
            });
            
            myMap.geoObjects.add(myPlacemark);
        }
    </script>
</head>
<body>
	<form method="GET">
		<input type="text" name="address" placeholder="Адрес" value="<?php echo $address ?>">
		<input type="submit" value="Найти">
	</form>
	<h2>По запросу найдены следующие адреса:</h2>
	<ul>
		<?php foreach ($collection as $item) {?>
			<li><a href="<?php echo 'index.php?address=' . $address . '&Latitude=' . $item->getLatitude() . '&Longitude=' . $item->getLongitude()?>"><?php echo $item->getAddress() ?></a></li>
		<?php } ?>
	</ul>

	<div id="map" style="width: 600px; height: 400px"></div>
</body>
</html>