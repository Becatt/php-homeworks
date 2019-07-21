<?php
namespace products\core;
    
class Product implements ProductInterface
{
    public $name;
    public $brand;
    public $model;
    public $price;
    private $discount;
    public $fullPrice;
    public $fullName;

    public function __construct($name, $brand, $model, $price, $discount)
    {
        $this->name = $name;
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->discount = $discount;
    }

    public function getHeader()
    {   
        $this->fullName = $this->name . ' ' . $this->brand .  ' ' . $this->model;
        $this->fullPrice = $this->price - $this->price*$this->discount/100;
        echo '<hr/>' . $this->fullName . ' цена ' . $this->fullPrice . ' руб. с учетом скидки ' . $this->discount . '%<br/>' ;
    }

    public function getDiscription()
    {
        echo 'Описание:<br/>Производитель - ' . $this->brand . '<br/>';
    }
}