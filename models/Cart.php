<?php
//додавання продукта
//видалення продукта
//відкрити кошик і подивитись що там є
//почистити кошик

class Cart{
    /**
     * додавання товару до кошику
     * вхідні дані:
     * ідентифікатор товару $product_id
     * кількість товару $quantity за замовчуванням =1
     */
    public function add($product_id,$quantity=1){
        session_start();
        if(isset($_SESSION['cart'][$product_id])){
            $_SESSION['cart'][$product_id] += $quantity;
        }else{
          $_SESSION['cart'][$product_id]=$quantity;  
        }
        
    }

    /**
     * видалення товару з кошика
     * вхідні дані:
     * ідентифікатор товару product_id
     */
    public function remove(){

    }


    /**
     * дістаємо товар з кошика
     * вхідні дані - не має
     * вертаємо масив товарів
     */
    public function getProducts(){
        session_start();
        return $_SESSION['cart'];
       
        
    }

    public function clear(){

    }


}

?>