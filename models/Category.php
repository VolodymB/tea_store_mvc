<?php
require_once "Model.php";
require_once "Product.php";
require_once "StatusProduct.php";
require_once "Unit.php";

class Category extends Model{
    private $id;
    public $name;
    public $parent_id;
    public $sort_order;
    public $parent;

    //функція для пошуку обєкта по id
    //заповнює обєкт елементами(складовими)
    //повертає обєкт і true\false
    public function find($id){
        $sql="SELECT * FROM `category` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        if($result=$this->db->select($sql,$data)){
            $this->id=$result[0]['id'];
            $this->name=$result[0]['name'];
            $this->parent_id=$result[0]['parent_id'];
            $this->sort_order=$result[0]['sort_order'];
            //отримання parent_id
            $this->parent=$this->getParent();
            return true;
        }
        return false;
    }

    public function save(){
        //формування масиву значень
        $data=array(
            'categoryname'=>$this->name,
            'parent_id'=>$this->parent_id,
            'sort_order'=>$this->sort_order
        );
        //якщо id рівний 0
        if(is_null($this->id)){
            //формування запиту на додавання
            $sql="INSERT INTO `category`(`name`, `parent_id`, `sort_order`) VALUES (:categoryname,:parent_id,:sort_order)";
        }else{
            //формування запиту на зміну існуючих даних
            $sql="UPDATE `category` SET `name`=:categoryname,`parent_id`=:parent_id,`sort_order`=:sort_order WHERE `id`=:id";
            //додавання до масиву значень елемента id і його значення
            $data['id']=$this->id;
        }
        //застосування функції для запису\зміни
        if($result=$this->db->query($sql,$data)){
            //надання властивості id значення result
            $this->id=$result;
            return true;
        }
        return false;
        }

        //функція для отримання батьківського id
        private function getParent(){
            //звернення до самої себе
            $parent=new self();
            //пошук по parent_id
            $parent->find($this->parent_id);
            return $parent;

        }

        //Отримання переліку товарів по його category_id
        public function getProducts(){
            $products=array();
            $sql="SELECT `product_id` FROM `product_category` WHERE `category_id`=:category_id";
            $data=array(
                'category_id'=>$this->id
            );
            if($result=$this->db->select($sql,$data)){
                //перебір результатів на елементи
                foreach($result as $item){
                    //Формування нового обєкта 
                    $product=new Product();
                    //застосування фукції з передачею в неї $item['product_id']
                    $product->find($item['product_id']);
                    //додавання в масив products значення з обєкта product
                    $products[]=$product;
                }
                return $products;
            }
        }

        //отрмання переліку категорій
        public function getList(){
            $sql="SELECT * FROM `category`";
            $data=array(

            );
            if($result=$this->db->select($sql,$data)){
                return $result;                
            }
        }

        //отримання id
        public function getId(){
            return $this->id;
        }


    
}
?>