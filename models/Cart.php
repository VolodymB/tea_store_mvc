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
    public function add($product_id,$unit_id=0,$quantity=1){
        //відкриття сесії
        session_start();
        //перевірка чи існує в сесії product_id
        if(isset($_SESSION['cart'][$product_id])){
            if(isset($_SESSION['cart'][$product_id][$unit_id])){
                //додавання кількості певного product_id
                $_SESSION['cart'][$product_id][$unit_id] += $quantity;
                return true;
            }  else {
                $_SESSION['cart'][$product_id][$unit_id]=$quantity;
                return true;       
            }           
        } else {           
            $_SESSION['cart'][$product_id] = array($unit_id=>$quantity);
            return true;       
        }
        return false;
    }

    /**
     * видалення товару з кошика
     * вхідні дані:
     * ідентифікатор товару product_id
     */
    public function remove($product_id,$unit_id){        
        if(isset($_SESSION['cart'][$product_id][$unit_id])){
            unset($_SESSION['cart'][$product_id][$unit_id]);
            if(empty($_SESSION['cart'][$product_id])){
                unset($_SESSION['cart'][$product_id]);
                if((empty($_SESSION['cart']))){
                    $this->clear();
                }
            }
        }
        
    }


    /**
     * дістаємо товар з кошика
     * вхідні дані - не має
     * вертаємо масив товарів
     */
    public function getProducts(){
        session_start();
        var_dump ($_SESSION['cart']);
        // die;
        //повернення показника cart з масиву _SESSION
        // array(2) { 
        //     [5]=>
        //     array(2) product id{
        //       [3]=> 
        //       int(5) unit id
        //       [2]=>
        //       int(3) quantity
        //     }
        //     [6]=>
        //     array(1) {
        //       [2]=>
        //       string(1) "1"
        //     }
        //   }
        $products=array();
        foreach($_SESSION['cart'] as $product_id => $info){  

            $product=new Product();
            $product->find($product_id);

            $param_units = array();
            foreach($info as $unit_id => $quantity){
                foreach($product->units as $unit){
                    if($unit->id === $unit_id){
                        $param_units[] = array(
                            'unit_id' => $unit->id,
                            'name' => $unit->name,
                            'quantity' => $quantity,
                            'price' => $unit->price 
                        );
                    }
                }
            }

            $products[] = array(
                'product_id' => $product->id,
                'name' => $product->name,
                'year' => $product->year,
                'image' => $product->images,
                'units' => $param_units,
            );            
            // $unit=new Unit();
            // $unit->find($_POST['unit_product']);

            // // array(1) { [0]=> array(1) { ["price"]=> float(300) } }
            // $price=$unit->getPrice($_POST['product_id'],$_POST['unit_product']);
        }
       return $products;
        
    }

    public function clear(){
        session_start();
        unset($_SESSION['cart']);
        header("Location:index.php");
    }


}

?>