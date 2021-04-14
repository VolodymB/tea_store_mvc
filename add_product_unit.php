<?php 
require_once "models/Product.php";
require_once "models/Unit.php";

if(isset($_GET['product_id']) && !empty(['product_id'])){
    $product_id=$_GET['product_id'];
    $product=new Product();
    if($product->find($product_id)){
        $unit=new Unit();
        $units=$unit->getList();
        include('views/product_form/add_units.php');
    }else{
        header("Location:add_product.php");
    }
}
?>