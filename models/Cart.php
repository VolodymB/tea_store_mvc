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
    //фунуція додавання товарів до кошику
    //приймає product_id, quantity (кількість) яка рівна по дефолту 1
    public function add($product_id,$quantity=1){
        //відкриття сесії
        session_start();
        //перевірка чи існує в сесії product_id
        if(isset($_SESSION['cart'][$product_id])){
            //додавання кількості певного product_id
            $_SESSION['cart'][$product_id] += $quantity;
        }else{
            //відображення фактичної кількості
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
        //повернення показника cart з масиву _SESSION
        return $_SESSION['cart'];
       
        
    }

    public function clear(){

    }


}

?>