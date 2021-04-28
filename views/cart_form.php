<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart_form</title>
</head>
<body>
    <table>
    <tr><th>Зображення</th><th>Назва</th><th>Одиниця виміру</th><th>Ціна за одниницю</th><th>Кількість</th><th>Загальна сумма</th></tr>
    <?php foreach($products as $product):?>
        <?php foreach($product['units'] as $unit):?>
        <?php if($product['images']){ ?>
        <?php foreach($product['images'] as $item_image){ ?>            
            <td><img src="<?=$item_image->image?>" style="max-width: 100px"></td>           
        <?php } ?>
        <?php }else{ ?>
            <td><p>Не має зображення</p></td>
            <?php } ?>
        <td><img src="<?=$item->image?>" style="max-width: 100px"></td>    
        <td><?=$product['name'].', '.$product['year']?></td>       
        <td><?=$unit['name']?></td>
        <td><?=$unit['price']?></td>                   
        <td><?=$unit['quantity']?></td>
        <td><?=($unit['price']*$unit['quantity'])?></td> 
         <td><a href="remowe_cart.php?product_id=<?=$product['product_id']?>&unit_id=<?=$unit['unit_id']?>">Відмінити позицію</a><td>   
        </tr>
    <?php endforeach; ?>
    <?php endforeach; ?>

    </table>
    <a href="index.php">Продовжити вибір</a><br>
    
</body>
</html>