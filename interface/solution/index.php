<?php

interface SuperInterfase{
    public function __construct($name, $id);
    public function getСondition();
}

abstract class SuperClass
{
    public $name;
    public $id;

    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function getСondition()
    {
        echo '<hr/>Состояние объекта "' . $this->name . ' ' . $this->id . '" :<br/>';
    }
}

interface CarInterface
{
    public function setBrand($brand);
    public function setColor($color);
    public function setGear($gear);
}

class Car extends SuperClass implements CarInterface
{   
    public $brand;
    private $color;
    public $gear;
    public $speed;
    private $rangeGear = 25;
    private $transmition = 6;
   
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }
	
    public function setGear($gear)
    {
        $this->gear = $gear;
        return $this;
    }

    public function getСondition()  
    {
        parent::getСondition();
        if ($this->gear > $this->transmition) {
	        echo 'недостаточно передач в коробке';
	    } else {
            $this->speed = $this->gear * $this->rangeGear;
            echo $this->color . ' ' . $this->name . ' ' . $this->brand . ' едет со скоростью ' . $this->speed . ' км/ч.' ;
	    }
    }
}

$carKia = new Car('автомобиль', 1);
$carKia->setBrand('Kia')
       ->setColor('Красный')
       ->setGear(6);
$carKia->getСondition();


$carOka = new Car('автомобиль', 2);
$carOka->setBrand('Ока')
       ->setColor('Белый')
       ->setGear(2);
$carOka->getСondition();

interface TVInterface
{
    public function setBrand($brand);
    public function setDiagonal($diagonal);
    public function setChannel($gear);
}

class TV extends SuperClass implements TVInterface
{
    public $brand;
    private $diagonal;
    public $channel;

    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function setDiagonal($diagonal)
    {
        $this->diagonal = $diagonal;
        return $this;
    }
    
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }
    
    public function getСondition() {
        parent::getСondition();
	    echo 'Смторим канал "' . $this->channel . '" на ' . $this->diagonal . ' дюймовом телевизоре ' . $this->brand . '.';
    }   
}

$tvSamsung = new TV('телевизор', 1);
$tvSamsung->setBrand('Samsung')
          ->setDiagonal(52)
          ->setChannel('Охота и рыбалка');
$tvSamsung->getСondition();

$tvRubin = new TV('телевизор', 2);
$tvRubin->setBrand('Рубин')
        ->setDiagonal(20)
        ->setChannel('Россия 1');
$tvRubin->getСondition();

interface BallPenInterface
{
    public function setBrand($brand);
    public function setColor($color);
}

class BallPen extends SuperClass implements BallPenInterface
{
    private $brand;
    private $color;

    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function getСondition() {
        parent::getСondition();
        echo 'Надпись имеет ' . $this->color . ' цвет и сделана ручкой фирмы "' . $this->brand . '".';
    }
}

$penKrause = new BallPen('ручка', 1);
$penKrause->setBrand('Erich Krause')
          ->setColor('синий');
$penKrause->getСondition();

$NoName = new BallPen('ручка', 2);
$NoName->setBrand('NoName')
         ->setColor('черный');
$NoName->getСondition();

interface DuckInterface
{
    public function setDuckName($duckName);
    public function setLeader($leader);
    public function setRoute($route);
    public function setFlightAltitude($flightAltitude);
}

class Duck extends SuperClass implements DuckInterface
{
    private $duckName;
    public $leader;
    public static $route = 'никуда';
    public static $flightAltitude = 0;

    public function setDuckName($duckName)
    {
        $this->duckName = $duckName;
        return $this;
    }

    public function setLeader($leader)
    {
        $this->leader = $leader;
        return $this;
    }

    public function setRoute($route)
    {

        if($this->leader == true) {
            self::$route = $route;
        }
        return $this;
    }

    public function setFlightAltitude($flightAltitude)
    {
         if($this->leader == true) {
            self::$flightAltitude = $flightAltitude;
        }
        return $this;
    }

    public function getСondition() 
    {
        parent::getСondition();
        echo $this->name . ' ' . $this->duckName . ' летит на высоте ' . self::$flightAltitude . ' метров в направлении ' . self::$route . '.';
    }
}

$CommonDuck1 = new Duck('утка', 1);
$CommonDuck1->setDuckName('Ренли')
           ->setLeader(false);
$CommonDuck1->getСondition();         

$leaderDuck = new Duck('утка', 2);
$leaderDuck->setDuckName('Роберт')
           ->setLeader(true)
           ->setRoute('юг')
           ->setFlightAltitude(20);
$leaderDuck->getСondition();

$CommonDuck2 = new Duck('утка', 3);
$CommonDuck2->setDuckName('Станнис')
            ->setLeader(false)
            ->setRoute('север')
            ->setFlightAltitude(40);
$CommonDuck2->getСondition();

interface ProductInterface
{
    public function setProduct($product);
    public function setPrice($price);
    public function setDiscount($discount);
}

class Product extends SuperClass implements ProductInterface
{   
    public $product;
    private $price;
    private $discount;

    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }


    public function getСondition()
    {   
        parent::getСondition();
        $newPrice = $this->price - $this->price*$this->discount/100;  
        
        echo $this->product->name . ' ' .  $this->product->brand . ' продается по цене ' . $newPrice . ' руб. с учетом скидки '. $this->discount . '%.';
    }
}

$auto = new Product('Продукт', 1);
$auto->setProduct($carKia)
     ->setPrice(1000000)
     ->setDiscount(10);
$auto->getСondition();

$tv = new Product('Продукт', 2);
$tv->setProduct($tvSamsung)
     ->setPrice(50000)
     ->setDiscount(5);
$tv->getСondition();
