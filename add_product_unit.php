<?php 
require_once "models/Product.php";
require_once "models/Unit.php";

// якщо існує $_GET['product_id'] і не пусте
if(isset($_GET['product_id']) && !empty(['product_id'])){
    $product_id=$_GET['product_id'];
    $product=new Product();
    // Якщо $product->find($product_id) рівно true 
    if($product->find($product_id)){
        $unit=new Unit();
        $units=$unit->getList();
        // підключення форми
        include('views/product_form/add_units.php');
    }else{
        // переадресація на файл
        header("Location:add_product.php");
    }
}
?>