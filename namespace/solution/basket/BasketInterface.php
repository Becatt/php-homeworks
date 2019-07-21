<?php
namespace basket;

interface BasketInterface
{
	public function addProduct($product);
	public function deleteAllProduct($product);
	public function deleteOneProduct($product);
	public function AllProducts();
	public function sumPrice();
}