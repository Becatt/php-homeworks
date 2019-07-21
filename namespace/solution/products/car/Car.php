<?php

namespace products\car;
use products\core\Product;

class Car extends Product implements CarInterface
{   
    public $color;
    public $maxSpeed;
    public $transmition;

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;
        return $this;
    }
	
    public function setTransmition($transmition)
    {
        $this->transmition = $transmition;
        return $this;
    }

    public function getDiscription()  
    {   
        parent::getDiscription();
        echo 'Цвет - ' . $this->color . '<br/>';
        echo 'Максимальная скорость - ' . $this->maxSpeed . '<br/>';
        echo 'Коробка передач - ' . $this->transmition . ' скоростей <br/>';
    }
}