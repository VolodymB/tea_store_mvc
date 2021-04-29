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
        <?php if($product->images){ ?>
        <?php foreach($product->images as $item){ ?>            
            <img src="<?=$item->image?>" style="max-width: 100px">           
        <?php } ?>
        <?php }else{ ?>
            <p>Не має зображення</p>
            <?php } ?>
        <ul>
        <?php foreach($product->units as $unit) {
            echo "<li>за $unit->name - $unit->price грн. </li>";
        }?>
        </ul>
        <br>        
        <!-- кнопка для створення товарної позиції -->
        <form action="cart.php" method='POST'>
        <select name="unit_product">
        <?php foreach($product->units as $unit) { ?>
            <option value=<?=$unit->id ?>><?php echo "за $unit->name - $unit->price грн."; ?></option>
        <?php } ?>
        </select>
        <br>
        <input type="hidden" name='product_id' value=<?=$product->id?>>
        <input type="number" name='quantity' min=1 value=1><br>
        <input type="submit" name='add_to_cart' value='add to cart'>
        </form>
        <br>
        <a href="index.php">Повернутись до попереднього меню</a><br>
        <a href="admin.php">Повернутись до списку</a><br>
   
    
</body>
</html>