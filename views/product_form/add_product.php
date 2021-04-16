<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
</head>
<body>
    <form action="" method='POST' enctype="multipart/form-data">
    <!-- стиль : червоний колір для слів -->
    <input type="text" name='name' placeholder='name' value="<?=$product->name?>"><br>
    <!-- Скорочений запис if(якщо існує $error['name']?виведення$error['name']:інакше false  ) -->
    <p style='color:red'><?=(isset($error['name']))?$error['name']:false?></p>
    <input type="number" name='year' placeholder='year' value="<?=$product->year?>"><br>
    <p style='color:red'><?=(isset($error['year']))?$error['year']:false?></p>
    <textarea name="description" placeholder='description'><?=$product->description?></textarea><br>
    <p style='color:red'><?=(isset($error['description']))?$error['description']:false?></p>
    <!-- Додавання зображення -->
    <!-- <input type="file" name='image'> -->
    <p>Оберіть статус</p>
    <!-- select для вибору статуса товару -->
    <select name="status">
    <?php foreach($list_status as $item){?>    
    <option value="<?=$item['id']?>" <?=($item['id']==$product->status->id)?'selected':false?>><?=$item['name']?></option>    
    <?php } ?>
    </select>
    <!-- необхідно зациклити диний сектор, для повторного вибору -->
    
    <!-- при натисканні продовжити, повторити форму -->
    <br>
    <input type="submit" name='send'><br>
    
    </form>
</body>
</html>