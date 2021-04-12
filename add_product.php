<?php
require_once "model/StatusProduct.php";
require_once "model/Product.php";

// $category=new Category();
//$categories=$category->getAll();- масив значень
$status=new StatusProduct();
$list_status=$status->getList();
$product=new Product();

if(isset($_POST['send'])){
    $error=array();    
    if(isset($_POST['name'])&& !empty($_POST['name'])){        
        $product->name=$_POST['name'];
    }else{
        $error['name']='enter name';
    }
    if(isset($_POST['year'])&& !empty($_POST['year'])){        
        $product->year=$_POST['year'];
    }else{
        $error['year']='enter year';
    }
    if(isset($_POST['description'])&& !empty($_POST['description'])){        
        $product->description=$_POST['description'];
    }else{
        $error['description']='enter description';
    }
    if(isset($_POST['status'])&& !empty($_POST['status'])){        
        $product->setStatusId($_POST['status']);
    }

    if(empty($error)){
        if($product->save()){
            header("Location:add_product_category.php?product_id=$product->id");
        }
    }
    
}

?>
