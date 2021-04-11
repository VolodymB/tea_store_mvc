<?php

$product_id=(isset($_GET['product_id']))?$_GET['product_id']:false;
if($product_id){
require_once "models/Product.php";
$product=new Product();
$product->find($product_id);
//достаем данные о продукте и подключаем файл отображения
include('views/product.php');
}else{
    header("Location:index.php");
}

?>