<?php
class Car
{
    public $brand;
    private $color;
    public $gear;
    public $speed;
    private $rangeGear = 25;
    private $transmition = 6;
   
    public function __construct($brand, $color)
    {
	    $this->brand = $brand;
	    $this->color = $color;
    }
	
    public function getSpeed($gear)  
    {
      $this->gear = $gear;
      if ($this->gear > $this->transmition) {
	      echo 'недостаточно передач в коробке';
	      } else {
            $this->speed = $this->gear * $this->rangeGear;
            echo $this->color . ' автомобиль ' . $this->brand . ' едет со скоростью ' . $this->speed . ' км/ч.<br/>' ;
	      }
    }
}

$carKia = new Car('Kia', 'Красный');
$carKia->getSpeed(6);

$carOka = new Car('Ока', 'Белый');
$carOka->getSpeed(1);



class TV
{
    public $brand;
    private $diagonal;
    public $channel;

    public function __construct($brand, $diagonal)
    {
    	$this->brand = $brand;
        $this->diagonal = $diagonal;
    }
    
    public function changeChannel($channel) {
        $this->channel = $channel;
	    echo 'Смторим канал "' . $this->channel . '" на ' . $this->diagonal . ' дюймовом телевизоре ' . $this->brand . '.<br>';
    }   
}

$tvSamsung = new TV('Samsung', 52);
$tvSamsung->changeChannel('Охота и рыбалка');

$tvRubin = new TV('Рубин', 21);
$tvRubin->changeChannel('Россия 1');

class BallPen {
    private $brand;
    private $color;

    public function __construct($brand, $color) 
    {
        $this->brand = $brand;
        $this->color = $color;
    }

    public function write() {
        echo 'Надпись имеет ' . $this->color . ' цвет и сделана ручкой фирмы "' . $this->brand . '".<br/>';
    }
}

$penKrause = new BallPen('Erich Krause', 'синий');
$penKrause->write();
$peNoName = new BallPen('NoName', 'черный');
$peNoName->write();


class Duck
{
    private $name;
    private $leader;
    private static $route = 'никуда';
    private static $flightAltitude = 0;

    public function __construct($name, $leader)
    {
        $this->name = $name;
        $this->leader = $leader;
    }

    public function fly($route, $flightAltitude) 
    {
        
        if($this->leader == true) {
            self::$route = $route;
            self::$flightAltitude = $flightAltitude;
        }
    echo 'Утка '. $this->name . ' летит на высоте ' . self::$flightAltitude . ' метров в направлении ' . self::$route . '.<br/>';
        
    }
}

$CommonDuck = new Duck('Ренли', false);
$CommonDuck->fly('север', 40);

$leaderDuck = new Duck('Роберт', true);
$leaderDuck->fly('юг', 20);

$CommonDuck = new Duck('Станис', false);
$CommonDuck->fly('север', 40);

class Product
{   
    public $product;
    private $price;
    private $catigoty;
    private $discount;

    public function __construct($product, $price, $discount)
    {
        $this->product = $product;
        $this->price = $price;
        $this->discount = $discount;
    }

    public function Discription($catigoty)
    {   
        $newPrice = $this->price - $this->price*$this->discount/100;
        $this->catigoty = $catigoty;  
        
        echo $this->catigoty . ' ' .  $this->product->brand . ' продается по цене ' . $newPrice . ' руб. с учетом скидки '. $this->discount . '%.<br/>';
    }
}

$auto = new Product($carKia, 1000000, 10);
$auto->Discription('Автомобиль');

$tv = new Product($tvSamsung, 50000, 5);
$tv->Discription('Телевизор');

?>