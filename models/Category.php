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
            $this->parent=$this->getParent();
            return true;
        }
        return false;
    }

    public function save(){
        $data=array(
            'categoryname'=>$this->name,
            'parent_id'=>$this->parent_id,
            'sort_order'=>$this->sort_order
        );
        if(is_null($this->id)){
            $sql="INSERT INTO `category`(`name`, `parent_id`, `sort_order`) VALUES (:categoryname,:parent_id,:sort_order)";
        }else{
            $sql="UPDATE `category` SET `name`=:categoryname,`parent_id`=:parent_id,`sort_order`=:sort_order WHERE `id`=:id";
            $data['id']=$this->id;
        }
        if($result=$this->db->query($sql,$data)){
            $this->id=$result;
            return true;
        }
        return false;
        }

        private function getParent(){
            $parent=new self();
            $parent->find($this->parent_id);
            return $parent;

        }

        public function getProducts(){
            $products=array();
            $sql="SELECT `product_id` FROM `product_category` WHERE `category_id`=:category_id";
            $data=array(
                'category_id'=>$this->id
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

        public function getList(){
            $sql="SELECT * FROM `category`";
            $data=array(

            );
            if($result=$this->db->select($sql,$data)){
                return $result;                
            }
        }

        public function getId(){
            return $this->id;
        }


    
}
?>