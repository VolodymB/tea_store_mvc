<?php
session_start();

require_once 'models/User.php';
require_once 'models/Product.php';



if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id']; 
    $user=new User();
    //заповлення обєкта Юзер
    $user->find($user_id);
    //перевірити роль користувача
    
    if($user->role!='menedger'){
      header("Location:index.php");
    }
    //дістати з Юзера імя і вкласти до змінної name
    $name=$user->name;  
  }

  $products=array();
  $product=new Product();
  $status=new StatusProduct();
//   array(29) {
//   [0]=>
//   array(5) {
//     ["id"]=>
//     int(1)
//     ["name"]=>
//     string(15) "Дянь Хун"
//     ["year"]=>
//     int(2020)
//     ["description"]=>
//     string(7) "fhgfkhg"
//     ["status_id"]=>
//     int(2)
//   }
  
  foreach($product->getList() as $item){
    $prod=new Product();    
    $prod->find($item['id']);
    $products[]=$prod;
  }

  
  // echo '<pre>';
  // var_dump($products[0]);
  // echo '</pre>';
  // die;





  include('views/admin_form.php');


?>