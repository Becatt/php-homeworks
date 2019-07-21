<?php

namespace products\core;

interface ProductInterface
{
    public function __construct($name, $brand, $model, $price, $discount);
    public function getHeader();
    public function getDiscription();
}