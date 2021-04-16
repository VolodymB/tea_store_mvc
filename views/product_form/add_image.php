<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method='POST'>
    <div>
    <?php if($product_id){ ?>
    <input type="submit" name='send'>
    <?php } ?>
    <input type="button" name='delete' value='видалити'>
    </div>
    <br>
    <div>
    <?php foreach($images as $image){ ?>
    <lable><input type="checkbox" name='images[]' value="<?=$image['id']?>">
    <img src="<?=$image['image']?>" style="max-width: 100px">
    <lable>
    <?php } ?>
    </div>
    </form>

</body>
</html>