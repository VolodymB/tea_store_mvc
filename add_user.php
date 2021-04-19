<?php
require_once "models/User.php";

if(isset($_POST['send'])){
    // array(6) { ["name"]=> string(6) "Viktor" ["surname"]=> string(6) "Holter" ["email"]=> string(19) "citicoffi@gmail.com" ["login"]=> string(5) "admin" ["password"]=> string(10) "23t43y7766" ["send"]=> string(18) "Надіслати" }
$user=new User();
$user->create($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['login'],$_POST['password']);
// var_dump($user);

}
include('views/user_form.php');

?>