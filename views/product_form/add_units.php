<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add Units</title>
</head>
<body>
    <?php if(isset($product_unit) && !empty($product_unit)){ ?>
    <!-- сторення таблиці і додати видалення построково (схоже на image) -->
    <?php
        echo '<pre>';
         var_dump($product_unit); 
         echo '</pre>';
         ?>
    <?php } ?>
    <form action="" method='POST'>
    <p>Одниція виміру</p>
    <!-- select для визначення одиниці виміру -->
    <select name="units">
    <?php foreach($units as $unit){
        // інший варіант запису option
        echo "<option value=".$unit['id'].">".$unit['name']."</option>";
    }?>
    </select>
    <p>Ціна</p>
    <input type="number" name='price' placeholder='price'><br>
    <p>Кількість</p>
    <input type="number" name='quantity' placeholder='quantity'><br>
    <input type="submit" name='add_unit'>Додати
    </form>
    <a href="">Продовжити</a><br>
    <a href="add_product.php?product_id=<?=$product_id?>">Повернутись до попереднього меню</a><br>
</body>
</html>