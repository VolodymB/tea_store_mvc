<?php 
require_once "Cart.php";

$cart=new Cart();
$cart->remove($_GET['product_id'],$_GET['unit_id']);
?>
