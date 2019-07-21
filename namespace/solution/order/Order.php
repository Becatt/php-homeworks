<?php
namespace order;
use basket\Basket;

class Order extends Basket implements OrderInterface
{	

	public function __construct($basket)
	{
		$this->Products = $basket->Products;
	}

	public function PrintOrder()
	{
		parent::AllProducts();
		parent::sumPrice();
		
	}
}	