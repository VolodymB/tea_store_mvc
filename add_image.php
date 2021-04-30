<?php
require_once "models/Image.php";
require_once "models/Product.php";

$product_id=false;
$image=new Image();


// перевірка чи вони фізично існують в папці
// створення форми для додавання нового зображення до таблиці і прописати її обробку
if(isset($_POST['add_image'])){
    if(isset($_FILES['image_file']) && $_FILES['image_file']['error']===0){
        if($image->setImage($_FILES['image_file'])){
            $image->save();
        }
    }
}
// форма для додавання зображення для продукта
if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    
    $product=new Product();
    if($product->find($_GET['product_id'])){
        // if(!empty($product->images)){
        //масив з id зображень товару
        $product_image=array();
        foreach($product->images as $image){
            $product_image[]=$image->id;
        }
        $product_id=$_GET['product_id'];
        if(isset($_POST['send'])){
            $new_images=array();
            if(isset($_POST['images']) && !empty($_POST['images'])){
                $new_images=$_POST['images'];
            }            
            $product->addImages($new_images);            
        }
        // }
    }

}
// Ввивести перелік існуючих в базі даних зображень
$images=$image->getList();
// підключення форми
include('views/product_form/add_image.php');
?>