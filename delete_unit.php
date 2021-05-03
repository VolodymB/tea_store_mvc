<?php
require_once 'models/Unit.php';
require_once 'models/product.php';

if(isset($_GET['product_id'])){
    $product_id=$_GET['product_id'];
}

if(isset($_GET['unit_id'])){
    $unit_id=$_GET['unit_id'];
    $unit=new Unit();
    if($unit->find($unit_id)){
        $product=new Product();
        if($product->deleteUnit($_GET['unit_id'])){
           header("Location:add_product_unit.php".(($product_id)?"?product_id=".$product_id:false)); 
        }
    }  
}    
        
    



?>