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
    <?php if($product->images){ ?>
        <?php foreach($product->images as $item_image){ ?>            
            <td><img src="<?=$item_image->image?>" style="max-width: 100px"></td>           
        <?php } ?>
        <?php }else{ ?>
            <p>Не має зображення</p>
            <?php } ?>
    <td><img src="<?=$item->image?>" style="max-width: 100px"></td>    
    <td><?=$product->name.', '.$product->year?></td>
    
    
    <td><?=$unit->name?></td>
    <td><?=$price[0]['price']?></td>        

           
    <td><?=$_POST['quantity']?></td>
                  
    <td><?php echo $price[0]['price']*$_POST['quantity'] ?></td> 
     <td><a href="">Відмінити позицію</a><td>   
    </tr>
    </table>
    <a href="index.php">Продовжити вибір</a><br>
    
</body>
</html>