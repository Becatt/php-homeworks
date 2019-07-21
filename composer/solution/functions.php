<?php
require_once(__DIR__ . '/vendor/autoload.php');

function CheckGet($get) {
	if(!empty($_GET[$get])){
		$get = $_GET[$get];
	} else {
		$get= '';
	}
	return $get;
}

$address = strip_tags(CheckGet('address'));
$latitude = (float)CheckGet('Latitude');
$longitude = (float)CheckGet('Longitude');

if (empty($latitude) || empty($longitude)) {
	$latitude = 55.704773;
	$longitude = 37.625091;
}

$collection = [];
$api  =  new  \Yandex\Geo\Api();

if (!empty($address)) {
// Или можно икать по адресу
	$api->setQuery($address);

	// Настройка фильтров
	$api
	    ->setLimit(10) // кол-во результатов
	    ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
	    ->load();

	$response = $api->getResponse();
	// Список найденных точек
	$collection = $response->getList();

	if ($latitude == 55.704773 || $longitude == 37.625091) {
		$latitude = $collection[0]->getLatitude();
		$longitude = $collection[0]->getLongitude();

	}
}