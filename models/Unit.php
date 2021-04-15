<?php


//підключаємо клас Model
// use model\Model;
require_once 'Model.php';

class Unit extends Model{
    private $id;
    public $name;
    public $price;
    public $quantity;

    public function find($id){
        $sql="SELECT * FROM `unit` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        if($result=$this->db->select($sql,$data)){
            $this->id=$result[0]['id'];
            $this->name=$result[0]['name'];
            return true;
        }
        return false;
    }

    public function save(){
        $data=array(
            'unitname'=>$this->name
        );
        if(is_null($this->id)){
            $sql="INSERT INTO `unit`(`name`) VALUES (:unitname)";//1              
        }else{
            $sql="UPDATE `unit` SET `name`=:unitname WHERE `id`=:id";//1
            $data['id']=$this->id;            
        }
        if($result=$this->db->query($sql,$data)){
            $this->id=$result;    
            return true;
            }
            return false;        
    }

    //Отримання товарів із відповідною одиницею виміру
    public function getProducts(){
        $products=array();
        $sql="SELECT `product_id` FROM `product_unit` WHERE `unit_id`=:unit_id";
        $data=array(
            'unit_id'=>$this->id
        );
        if($result=$this->db->select($sql,$data)){
            foreach($result as $item){
                $product=new Product();
                $product->find($item['product_id']);
                $products[]=$product;
            }
            return $products;
        }
    }

    //перелік всіх одиниць виміру
        public function getList(){
        $sql="SELECT * FROM `unit`";
        $data=array(

        );
        if($result=$this->db->select($sql,$data)){
            return $result;                
        }
    }


}
?>