<?php
require_once "models/Product.php";

if(isset($_GET['product_id'])){
    $product_id=$_GET['product_id'];

    $product=new Product();
    $product->find($product_id);
    echo '<pre>';
    var_dump($product);
    echo '</pre>';
    
}




?>