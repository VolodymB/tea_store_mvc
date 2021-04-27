<?php
require_once "models/Cart.php";
require_once "models/Product.php";
require_once "models/Unit.php";

$cart=new Cart();

//array(4) { ["unit_product"]=> string(1) "2" ["product_id"]=> string(1) "6" ["quantity"]=> string(1) "1" ["add_to_cart"]=> string(11) "add to cart" }
if (isset($_POST['add_to_cart'])){
    // $cart->clear();
    $cart->add($_POST['product_id'],$_POST['unit_product'],$_POST['quantity']);                      
}

$products = $cart->getProducts();

include('views/cart_form.php');
?>