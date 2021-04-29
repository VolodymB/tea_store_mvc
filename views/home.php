<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Hello, <?=(isset($name))?$name:'guest'?></h1>
<?php if (isset($name)){ ?>
    <a href="admin.php">Режим адміністратора</a><br>
    
<?php }else{ ?>
    <a href="add_user.php">Реєсстрація</a>
<?php } ?>
<table>
    
    <?php foreach($products as $product){ 
        if (!empty($product->units)){ ?>
    <tr>
    <td></td>
    <td><?=$product->name.','.$product->year ?></td>
    <td><?=$product->description  ?></td>
    <td><ul>
    <?php foreach($product->categories as $category) {
        // формування списку 
        echo "<li>$category->name</li>";
    }?>
    
    </ul></td>
    <td><ul>
    <!-- цикл -->
    <?php foreach($product->units as $unit) {
        // формування значенню списку
        echo "<li>за $unit->name - $unit->price грн. </li>";
    }?>
    
    </ul></td>
    <td><?=$product->status->name ?></td>  
      <!-- перехід на файл view по product_id  -->
    <td><a href="view.php?product_id=<?=$product->id ?>">Перегляд</a></td>  
    </tr>
    <?php }
        } ?>
    </table>
    <?php if (isset($name)){ ?>
        <a href="logout.php">logout</a>
<?php }else{ ?>
    <a href="login.php">Login</a>
<?php } ?>

</body>
</html>