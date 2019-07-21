<?php

namespace products\duck;
use products\core\Product;

class Duck extends Product implements DuckInterface
{   
    public $color;
    public $maxFlightAltitude;

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function setMaxFlightAltitude($maxFlightAltitude)
    {
        $this->maxFlightAltitude = $maxFlightAltitude;
        return $this;
    }
	
    public function getDiscription()  
    {   
        parent::getDiscription();
        echo 'Цвет - ' . $this->color . '<br/>';
        echo 'Максимальная высота полета(м) - ' . $this->maxFlightAltitude . '<br/>';
    }
}