<?php 
require_once "models/Product.php";
require_once "models/Unit.php";



// якщо існує $_GET['product_id'] і не пусте
if(isset($_GET['product_id']) && !empty(['product_id'])){
    $product_id=$_GET['product_id'];
    $product=new Product();
    // Якщо $product->find($product_id) рівно true 
    if($product->find($product_id)){
        // перелік unit товару
        $product_unit=array();
        $product_unit=$product->units;
        

        $unit=new Unit();
        $units=$unit->getList();
        

        
        if(isset($_POST['add_unit'])){
            $data=array();
            if(isset($_POST['units']) && !empty($_POST['units'])){
                $data['units']=$_POST['units'];
                if(isset($_POST['price']) && ($_POST['price']>0)){
                    $data['price']=$_POST['price'];
                    if(isset($_POST['quantity']) && ($_POST['quantity']>0)){
                        $data['quantity']=$_POST['quantity'];
                            if($product->addUnits($data)){
                            header("Location:view.php?product_id=$product->id");
                            }else{
                                echo 'oops add unit';
                            }
                                }
                }
            }
          //array(4) { ["units"]=> string(1) "1" ["price"]=> string(3) "350" ["quantity"]=> string(1) "1" ["add_unit"]=> string(18) "Надіслати" }
            
           
        }else{
            echo 'oops add category';
        }
        // підключення форми
        include('views/product_form/add_units.php');
    }else{
        // переадресація на файл
        header("Location:add_product.php");
    }
}
?>