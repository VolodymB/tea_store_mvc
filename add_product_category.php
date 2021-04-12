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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1><?=$product->name.', '.$product->year?></h1>
    <p><?=$product->description?></p>
    <p><?=$product->status->name?></p>
    <form action="" method='POST'>
    <?php foreach($categories as $item){ ?>
    <input type="checkbox" name='category[]' value='<?=$item['id']?>'><?=$item['name']?>
    <?php } ?>
    <input type="submit" name='add_category' >
    </form>
</body>
</html>