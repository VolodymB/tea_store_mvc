
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1><?=$product->name.', '.$product->year?></h1>
    <p><?=$product->description?></p>
    <p><?=$product->status->name?></p>
    <form action="" method='POST'>
    <?php foreach($categories as $item){ ?>
    <input type="checkbox" name='category[]' value='<?=$item['id']?>'><?=$item['name']?>
    <?php } ?>
    <input type="submit" name='add_category' >
    </form>
</body>
</html>