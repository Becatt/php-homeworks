<?php

namespace products\ballpen;
use products\core\Product;

class BallPen extends Product implements BallPenInterface
{   
    public $color;
    public $material;

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function setMaterial($material)
    {
        $this->material = $material;
        return $this;
    }
	
    public function getDiscription()  
    {   
        parent::getDiscription();
        echo 'Цвет - ' . $this->color . '<br/>';
        echo 'Материал корпуса - ' . $this->material . '<br/>';
    }
}