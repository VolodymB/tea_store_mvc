<?php
require_once 'models/User.php';
session_start();
if(isset($_POST['send'])){
    $user=new User();
    // якщо id рівний значенню user властивості login із значенням POST є true 
    if($id=$user->login($_POST['email'],$_POST['login'],$_POST['password'])){
        // параметр сесії user_id який рівний $id
        $_SESSION['user_id']=$id;        
        header("Location:index.php");
    }else{
        echo "введіть правильні дані";
    }
}
include('views/login_form.php');
?>

