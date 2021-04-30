<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<h1>Hello, <?=(isset($name))?$name:'guest'?></h1>
<a href="add_product.php">Додати товар</a><br>
<table>
 <tr><th>Назва</th>
 <th>Статус товару</th></tr>
 <tr>
 <?php foreach($products as $product){ ?>
<td><?=$product->name.','.$product->year ?></td>
<td><?=$product->status->name ?></td>
<td><a href="view.php?product_id=<?=$product->id ?>">Детальніше</a></td>
<td><a href="add_product.php?product_id=<?=$product->id?>">Редагувати інформацію</a></td>
<td><a href="delete_product.php?product_id=<?=$product->id?>">Видалити</a></td>
 </tr>
 <?php } ?>
 </table>
  <br>
<a href="index.php">Повернутись до попереднього меню</a><br>
</body>
</html>