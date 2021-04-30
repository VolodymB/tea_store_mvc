
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- заголовок назва, рік -->
<h1><?=$product->name.', '.$product->year?></h1>
    <p><?=$product->description?></p>
    <p><?=$product->status->name?></p>
    <form action="" method='POST'>
<!-- розділ масиву на елементи -->
    <?php foreach($categories as $item){ ?>
    <input type="checkbox" name='category[]' value='<?=$item['id']?>' <?=(in_array($item['id'],$product_category))?'checked':false?> ><?=$item['name']?>
    <?php } ?>
    <input type="submit" name='add_category' >
    </form>
    <a href="add_product.php?product_id=<?=$product_id?>">Повернутись до попереднього меню</a>
</body>
</html>