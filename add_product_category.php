<?php
require_once "model/Product.php";
require_once "model/Category.php";

if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    $product_id=$_GET['product_id'];
    $product=new Product();
    if($product->find($product_id)){
        $category=new Category();
        $categories=$category->getList();
        //вивести інформацію про товар
        //форма для категорії
    }else{
        header("Location:add_product.php");
    }
}
?>
