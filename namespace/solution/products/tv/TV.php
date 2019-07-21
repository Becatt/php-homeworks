<?php

namespace products\tv;
use products\core\Product;

class TV extends Product implements TVInterface
{   
    public $color;
    public $diagonal;

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function setDiagonal($diagonal)
    {
        $this->diagonal = $diagonal;
        return $this;
    }
	
    public function getDiscription()  
    {   
        parent::getDiscription();
        echo 'Цвет - ' . $this->color . '<br/>';
        echo 'Диагональ(дюймы) - ' . $this->diagonal . '<br/>';
    }
}