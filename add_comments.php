<?php
require_once 'models/User.php';
require_once 'models/Product.php';
require_once 'models/Comment.php';

session_start();
$user_id=$_SESSION['user_id'];

if(isset($user_id) && !empty($user_id)){
    if(isset($_GET['product_id'])){
        $product_id=$_GET['product_id'];

        $comment=new Comment();
        $comment->find($product_id);
        echo '<pre>';
        var_dump($comment); 
        echo '</pre>'; 
        die;      
}
}


include('views/product_form/add_comment.php');
?>