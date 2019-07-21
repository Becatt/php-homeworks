<?php
require_once(__DIR__ . '/autoloader.php');
spl_autoload_register('myAutoload');

use products\car\Car, products\tv\TV, products\ballpen\BallPen, products\duck\Duck, basket\Basket, order\Order;

echo 'ТОВАРЫ';

$carKia = new Car('автомобиль', 'Kia', 'Rio', 900000, 10);
$carKia->setColor('Красный')
       ->setMaxSpeed(180)
       ->setTransmition(6);
$carKia->getHeader();
$carKia->getDiscription();


$carVaz = new Car('автомобиль', 'АвтоВаз', 'Веста', 600000, 5);
$carVaz->setColor('Белый')
       ->setMaxSpeed(170)
       ->setTransmition(6);
$carVaz->getHeader();
$carVaz->getDiscription();

$tvLg = new TV('телевизор', 'LG', 'N001', 40000, 15);
$tvLg->setColor('Белый')
       ->setDiagonal(49);
$tvLg->getHeader();
$tvLg->getDiscription();

$tvSony = new TV('телевизор', 'Sony', 'S001', 150000, 20);
$tvSony->setColor('Серый')
       ->setDiagonal(100);
$tvSony->getHeader();
$tvSony->getDiscription();

$bpErich = new BallPen('ручка', 'Erich Krause', 'Prestige', 50000, 3);
$bpErich->setColor('Черный')
       ->setMaterial('Металл');
$bpErich->getHeader();
$bpErich->getDiscription();

$bpNoName = new BallPen('ручка', 'NoName', '1', 15, 0);
$bpNoName->setColor('Синий')
       ->setMaterial('Пластик');
$bpNoName->getHeader();
$bpNoName->getDiscription();

	
$duckKarl = new Duck('утка', '', 'Карл', 5000, 10);
$duckKarl->setColor('Черный')
       ->setMaxFlightAltitude('200');
$duckKarl->getHeader();
$duckKarl->getDiscription();

$duckRobert = new Duck('утка', '', 'Роберт', 3000, 7);
$duckRobert->setColor('Серый')
       ->setMaxFlightAltitude('100');
$duckRobert->getHeader();
$duckRobert->getDiscription();

echo '<hr/>КОРЗИНА';

$basket = new Basket;
$basket->addProduct($duckRobert);
$basket->addProduct($bpErich);
$basket->addProduct($carKia);
$basket->addProduct($carKia);
$basket->addProduct($tvSony);
$basket->addProduct($tvSony);
$basket->addProduct($tvLg);
$basket->addProduct($tvLg);
$basket->addProduct($duckKarl);
$basket->AllProducts();
$basket->sumPrice();
$basket->deleteAllProduct($tvSony);
$basket->deleteOneProduct($carKia);
$basket->AllProducts();
$basket->sumPrice();

echo '<hr/>ЗАКАЗ';

$order = new Order($basket);
$order->PrintOrder();
$order->deleteOneProduct($duckKarl);
$order->deleteOneProduct($tvLg);
$order->addProduct($carVaz);
$order->addProduct($bpNoName);
$order->PrintOrder();