<?php
require_once 'models/User.php';
session_start();
if(isset($_POST['send'])){
    $user=new User();
    if($id=$user->login($_POST['email'],$_POST['login'],$_POST['password'])){
        $_SESSION['user_id']=$id;        
        header("Location:index.php");
    }else{
        echo "введіть правильні дані";
    }
}
include('views/login_form.php');
?>

