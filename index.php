<?php
session_start();
require_once 'models/Category.php';
require_once 'models/User.php';

if(isset($_SESSION['user_id'])){
  $user_id=$_SESSION['user_id']; 
  $user=new User();
  //заповлення обєкта Юзер
  $user->find($user_id);
  //дістати з Юзера імя і вкласти до змінної name
  $name=$user->name;
  echo 'Hello'.', '.$name;
}


// $name = 'Lena';

$category=new Category();
$category->find(1);
$category->name='Хіт продажу';
$category->parent_id=11;
$category->sort_order=7;
$products = $category->getProducts();

include('views/home.php');
?>