<?php
// echo '<pre>';
// var_dump($product);
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
    <ul>
    <?php foreach($product->units as $unit) {
        echo "<li>за $unit->name - $unit->price грн. </li>";
    }?>
    </ul>
    <a href="cart.php?product_id=<?=$product->id?>">add to cart</a>
</body>
</html>