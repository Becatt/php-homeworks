<?php
namespace basket;

class Basket implements BasketInterface
{
public $Products = [];
   
    public function addProduct($product){                                      
       $product->numProduct = 1;
       
        if(array_key_exists($product->fullName, $this->Products)){
            $this->Products[$product->fullName]->numProduct++;
        }
        else{
            $this->Products[$product->fullName] = $product;
        }
    }
    
    public function deleteAllProduct($product)
    {
        unset($this->Products[$product->fullName]);
    }
    
    public function deleteOneProduct($product)
    {
        if(array_key_exists($product->fullName, $this->Products)){
        
            if($this->Products[$product->fullName]->numProduct > 1){
            
                 $this->Products[$product->fullName]->numProduct--;
            } else {
            unset($this->Products[$product->fullName]);      
            } 
        }
    }
 
    public function AllProducts()
    {
        echo '<hr/><hr/>';
        $resProducts = 0;
        
        foreach($this->Products as $key => $value)
        {
            echo 'Товар: ' . $key . ', цена ' . $value->fullPrice . ' руб., количество: ' . $value->numProduct . '<br>';
            
            $resProducts = $resProducts + $value->numProduct;         
        }
        echo '<hr/>Всего товаров: ' . $resProducts;
        
    }
    
    public function sumPrice()
    {
        $sum = 0;
        
        foreach($this->Products as $key => $value)
        {
            $sum = $sum + ($value->fullPrice * $value->numProduct);
        }
        echo ', на сумму ' . $sum . ' руб.<br/>';
        
    }
}