<?php
require_once 'model/User.php';
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorithaion form</title>
</head>
<body>
<p><h1>Добрий день</h1></p>
    <p>Авторизуйтесь будь ласка</p><br>
    <form action="" method='POST'>
    <input type="text" name='email' placeholder='email'><br>
    <input type="text" name='login' placeholder='login'><br>
    <input type="text" name='password' placeholder='password'><br>
    <input type="submit" name='send'><br>
    </form>
    <p>або</p><br>
    <a href="registration.php">Реєстрація </a>
</body>
</html>

