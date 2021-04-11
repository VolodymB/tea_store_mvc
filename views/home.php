<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
    if(isset($_SESSION['user_id'])){
    ?>
   <h1>Hello, <?=(isset($name))?$name:'guest'?></h1>

   <table>
    <tr>
    <?php foreach($products as $product){ ?>
    <td></td>
    <td><?=$product->name.','.$product->year ?></td>
    <td><?=$product->description  ?></td>
    <td><ul>
    <?php foreach($product->categories as $category) {
        echo "<li>$category->name</li>";
    }?>
    
    </ul></td>
    <td><ul>
    <?php foreach($product->units as $unit) {
        echo "<li>за $unit->name - $unit->price грн. </li>";
    }?>
    
    </ul></td>
    <td><?=$product->status->name ?></td>    
    <td><a href="view.php?product_id=<?=$product->id ?>">Перегляд</a></td>    

    </tr>
    <?php } ?>
    </table>
    <a href="logout.php">logout</a>
    <?php }else{ ?>
        <h1>Hello, <?=(isset($name))?$name:'guest'?></h1>

   <table>
    <tr>
    <?php foreach($products as $product){ ?>
    <td></td>
    <td><?=$product->name.','.$product->year ?></td>
    <td><?=$product->description  ?></td>
    <td><ul>
    <?php foreach($product->categories as $category) {
        echo "<li>$category->name</li>";
    }?>
    
    </ul></td>
    <td><ul>
    <?php foreach($product->units as $unit) {
        echo "<li>за $unit->name - $unit->price грн. </li>";
    }?>
    
    </ul></td>
    <td><?=$product->status->name ?></td>    
    <td><a href="view.php?product_id=<?=$product->id ?>">Перегляд</a></td>    

    </tr>
    <?php } ?>
    </table>
    <a href="login.php">Login</a>
    <?php } ?>
</body>
</html>