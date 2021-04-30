<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add image</title>
</head>
<body>
    <form action="" method='POST' enctype="multipart/form-data">
    <input type="file" name='image_file'><br>
    <input type="submit" name='add_image' value='нове зображення'><br>
    </form>
    <form action="" method='POST'>
    <div>
    <?php if($product_id){ ?>
    <input type="submit" name='send' value='додати до товару'>
    <?php } ?>
    <input type="button" name='delete' value='видалити'>     
    </div>
    <br>
    <div>
    <?php foreach($images as $image){ ?>
    <lable><input type="checkbox" name='images[]' value="<?=$image['id']?>" <?=(in_array($image['id'],$product_image))?'checked':false?>>
    <img src="<?=$image['image']?>" style="max-width: 100px">
    <a href="delete_image.php?image_id=<?=$image['id']?><?=($product_id)?'&product_id='.$product_id:false?>">Видалення</a> 
    <lable>
    <?php } ?>
    </div>
    </form>
    <?php if($product_id){ ?>
        <a href="add_product.php?product_id=<?=$product_id?>">Повернутись до попереднього меню</a>
    <?php } ?>
   
    
</body>
</html>