<?php
require_once "models/Image.php";
require_once "models/Product.php";

$product_id=false;
$image=new Image();
// Ввивести перелік існуючих в базі даних зображень
$images=$image->getList();

// перевірка чи вони фізично існують в папці
// створення форми для додавання нового зображення до таблиці і прописати її обробку
// форма для додавання зображення для продукта
if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    
    $product=new Product();
    if($product->find($_GET['product_id'])){
        $product_id=$_GET['product_id'];
    }

}
// підключення форми
include('views/product_form/add_image.php');
?>