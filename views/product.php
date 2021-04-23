<?php
// echo '<pre>';
// var_dump($product->images);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>   
        <h1><?=$product->name.', '.$product->year?></h1>
        <p><?=$product->description?></p>
        <?php foreach($product->images as $item){ ?>
            <img src="<?=$item->image?>" style="max-width: 100px">
        <?php } ?>
        <ul>
        <?php foreach($product->units as $unit) {
            echo "<li>за $unit->name - $unit->price грн. </li>";
        }?>
        </ul>
        <br>
        <?php if($user_id){?>
        <a href="add_product.php?product_id=<?=$product->id?>">Редагувати інформацію</a><br>
        <?php }?>
        <!-- кнопка для створення товарної позиції -->
        <a href="cart.php?product_id=<?=$product->id?>">add to cart</a>
        <br>
        <a href="index.php">Повернутись до попереднього меню</a>
   
    
</body>
</html>