<?php
require_once "models/Cart.php";

$cart=new Cart();
$cart->add($_GET['product_id']);
var_dump($cart->getProducts());
?>