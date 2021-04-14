<?php
require_once "models/Product.php";
require_once "models/Category.php";

if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
    $product_id=$_GET['product_id'];
    $product=new Product();
    if($product->find($product_id)){
        $category=new Category();
        $categories=$category->getList();
        $product_category=array();
        foreach($product->categories as $item){
            $product_category[]=$item->getId();
        }
        if(isset($_POST['add_category'])){
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
