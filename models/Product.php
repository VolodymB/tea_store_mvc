<?php
require_once "Model.php";
require_once "Category.php";

class Product extends Model{
    public $id;
    public $name;
    public $year;
    public $description;
    private $status_id;
    public $categories;
    public $units;

    public function find($id){
        $sql="SELECT * FROM `product` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        if($result=$this->db->select($sql,$data)){
            $this->id=$result[0]['id'];
            $this->name=$result[0]['name'];
            $this->year=$result[0]['year'];
            $this->description=$result[0]['description'];
            $this->status_id=$result[0]['status_id'];
            $this->categories = $this->getCategories();
            $this->status=$this->getStatus();
            $this->units = $this->getUnits();
            return true;
        }
        return false;
    }

    public function save(){
        $data=array(
            'productName'=>$this->name,
            'productYear'=>$this->year,
            'productDescription'=>$this->description,
            'status_id'=>$this->status_id           
        );
        if(is_null($this->id)){
        $sql="INSERT INTO `product`(`name`, `year`, `description`, `status_id`) VALUES (:productName,:productYear,:productDescription,:status_id)";
        }else{
            $sql="UPDATE `product` SET `name`=:productName,`year`=:productYear,`description`=:productDescription,`status_id`=:status_id WHERE `id`=:id";
            $data['id']=$this->id;
        }
        if($result=$this->db->query($sql,$data)){
            return true;
        }
        return false;
    }

    public function getCategories(){
        $categories=array();
        $sql="SELECT `category_id` FROM `product_category` WHERE `product_id`=:product_id";
        $data=array(
            'product_id'=>$this->id
        );        
        if($result=$this->db->select($sql,$data)){
            //array(2) { [0]=> array(1) { ["category_id"]=> int(3) } [1]=> array(1) { ["category_id"]=> int(9) } }
            foreach($result as $item){ 
                $category = new Category();   
                $category->find($item['category_id']);
                $categories[]=$category;
            }           
            return $categories;
        }
    }

    public function getStatus(){
        $status=new StatusProduct();
        $status->find($this->status_id);
        return $status;
       }

       public function getUnits(){
           $units=array();
           $sql="SELECT * FROM `product_unit` WHERE `product_id`=:product_id";
           $data=array(
               'product_id'=>$this->id
           );
           if($resolt=$this->db->select($sql,$data)){
                foreach ($resolt as $item){                  
                    $unit=new Unit();
                    $unit->find($item['unit_id']);
                    $unit->price=$item['price'];
                    $units[]=$unit;
                }                
           }
           return $units;
       }


}