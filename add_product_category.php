<?php
require_once "models/Product.php";
require_once "models/Category.php";

if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    $product_id=$_GET['product_id'];
    $product=new Product();
    if($product->find($product_id)){
        $category=new Category();
        // створення переліку категорій, застовавши до властивості category застосовується функція getList
        $categories=$category->getList();
        $product_category=array();
        foreach($product->categories as $item){
            // в масив  $product_category додається значення функції getId
            $product_category[]=$item->getId();
        }
        if(isset($_POST['add_category'])){
            // якщо значення функції addCategories для $product із значеням $_POST['category'] рівна true
            if($product->addCategories($_POST['category'])){
                header("Location:add_product_unit.php?product_id=$product->id");
            }else{
                echo "no";
            }

        }
        //вивести інформацію про товар
        //форма для категорії
        include('views/product_form/add_category.php');
    }else{
        header("Location:add_product.php");
    }
}
?>
