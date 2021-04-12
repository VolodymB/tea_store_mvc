<?php
require_once "model/StatusProduct.php";
require_once "model/Product.php";

// $category=new Category();
//$categories=$category->getAll();- масив значень
$status=new StatusProduct();
$list_status=$status->getList();
$product=new Product();

if(isset($_POST['send'])){
    $error=array();    
    if(isset($_POST['name'])&& !empty($_POST['name'])){        
        $product->name=$_POST['name'];
    }else{
        $error['name']='enter name';
    }
    if(isset($_POST['year'])&& !empty($_POST['year'])){        
        $product->year=$_POST['year'];
    }else{
        $error['year']='enter year';
    }
    if(isset($_POST['description'])&& !empty($_POST['description'])){        
        $product->description=$_POST['description'];
    }else{
        $error['description']='enter description';
    }
    if(isset($_POST['status'])&& !empty($_POST['status'])){        
        $product->setStatusId($_POST['status']);
    }

    if(empty($error)){
        if($product->save()){
            header("Location:add_product_category.php?product_id=$product->id");
        }
    }
    
}

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
    <form action="" method='POST'>
    <input type="text" name='name' placeholder='name' value="<?=$product->name?>"><br>
    <p style='color:red'><?=(isset($error['name']))?$error['name']:false?></p>
    <input type="number" name='year' placeholder='year' value="<?=$product->year?>"><br>
    <p style='color:red'><?=(isset($error['year']))?$error['year']:false?></p>
    <textarea name="description" placeholder='description'><?=$product->description?></textarea><br>
    <p style='color:red'><?=(isset($error['description']))?$error['description']:false?></p>
    <!-- <input type="image" name='image'  src=""> -->
    <!-- <p>Вибір категорії</p>
    <input type="checkbox" name='category' value='1'>1<br>
    <input type="checkbox" name='category' value='2'>2<br>
    <input type="checkbox" name='category' value='3'>3<br> -->
    <p>Оберіть статус</p>
    <select name="status">
    <?php foreach($list_status as $item){?>    
    <option value="<?=$item['id']?>" <?=($item['id']==$product->status->id)?'selected':false?>><?=$item['name']?></option>    
    <?php } ?>
    </select>
    <!-- необхідно зациклити диний сектор, для повторного вибору -->
    <!-- <p>Одниція виміру</p>
    <select name="units">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    </select>
    <p>Ціна</p>
    <input type="number" name='price' placeholder='price'><br>
    <p>Кількість</p>
    <input type="number" name='quantity' placeholder='quantity'><br>
    <a href="">Продовжити</a><br> -->
    <!-- при натисканні продовжити, повторити форму -->
    <br>
    <input type="submit" name='send'><br>
    
    </form>
</body>
</html>