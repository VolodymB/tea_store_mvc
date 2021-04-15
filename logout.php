<?php
// старт сесії
session_start();
// видалення параметра сесії
unset($_SESSION['user_id']);
// переадресація
header("Location:login.php")
?>