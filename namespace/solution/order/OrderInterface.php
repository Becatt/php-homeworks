<?php
namespace order;

interface OrderInterface
{
	public function __construct($basket);
	public function PrintOrder();
}
