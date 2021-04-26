<?php
require_once "models/Cart.php";
require_once "models/Product.php";
require_once "models/Unit.php";

//array(4) { ["unit_product"]=> string(1) "2" ["product_id"]=> string(1) "6" ["quantity"]=> string(1) "1" ["add_to_cart"]=> string(11) "add to cart" }
if (isset($_POST['add_to_cart'])){
    $cart=new Cart();
    // $cart->clear();
    $cart->add($_POST['product_id'],$_POST['unit_product'],$_POST['quantity']);
            
    $paroducts=array();
    $product=new Product();
    $product->find($_POST['product_id']);

    $unit=new Unit();
    $unit->find($_POST['unit_product']);
    // array(1) { [0]=> array(1) { ["price"]=> float(300) } }
    $price=$unit->getPrice($_POST['product_id'],$_POST['unit_product']);
    // var_dump($price);
    // die;
    
            
            
}

var_dump($cart->getProducts());
include('views/cart_form.php');
?>