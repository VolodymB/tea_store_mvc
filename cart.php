<?php
require_once "models/Cart.php";

//array(4) { ["unit_product"]=> string(1) "2" ["product_id"]=> string(1) "6" ["quantity"]=> string(1) "1" ["add_to_cart"]=> string(11) "add to cart" }
if (isset($_POST['add_to_cart'])){
    $cart=new Cart();
    // $cart->clear();
    $cart->add($_POST['product_id'],$_POST['unit_product'],$_POST['quantity']);
    
}

var_dump($cart->getProducts());
?>