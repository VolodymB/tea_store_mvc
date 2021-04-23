<?php
require_once "Model.php";
require_once "Category.php";
require_once 'StatusProduct.php';
require_once 'Image.php';

class Product extends Model{
    public $id;
    public $name;
    public $year;
    public $description;
    private $status_id;
    public $categories;
    public $units;
    public $images;

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
            $this->images =$this->getImages();
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
            $this->id=$result;
            return true;
        }
        return false;
    }

    //функція для додавання Категорій чаю, вноситься масив Категорій
    public function addCategories(array $categories){
        //довання циклом до таблиці Category_Product 
        $data=array(
            'product_id'=>$this->id,
        );
        //видалення всіх записів про товар
        $sql='DELETE FROM `product_category` WHERE `product_id`=:product_id';
        if($result=$this->db->none_query($sql,$data)){
         $sql='INSERT INTO `product_category`(`category_id`, `product_id`) VALUES (:category_id,:product_id)';
        foreach($categories as $category){
            //до масиву data  category_id  отримує значення $category
            $data['category_id']=$category;            
            $result=$this->db->none_query($sql,$data);
            //якщо $result є false
            if(!$result){
            return false;
            }        
        }
           return true;
        }
        return false;        
    }

    //Функція для отримання переліку кетегорій товару 
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


    //функція для визначення статуса продукту
    public function getStatus(){
        $status=new StatusProduct();
        //функція find із значенням властивості status_id
        $status->find($this->status_id);
        return $status;
       }

       //призначення статуса , вноситься цифрове значення $status_id
       public function setStatusId(int $status_id){
        $this->status_id=$status_id;
       }

       //визначення одиниць виміру по товару
       public function getUnits(){
           $units=array();
           $sql="SELECT * FROM `product_unit` WHERE `product_id`=:product_id";
           $data=array(
               'product_id'=>$this->id
           );
           if($result=$this->db->select($sql,$data)){
                foreach ($result as $item){                  
                    $unit=new Unit();
                    $unit->find($item['unit_id']);
                    $unit->price=$item['price'];
                    $units[]=$unit;
                }                
           }
           return $units;
       }

       //коментарі на окремий товар
       public function getComments(){
        $comments=array();           
        $data=array(
            'productId'=>$this->id
        );
        $sql="SELECT * FROM `comment` WHERE `product_id`=:productId";
        if($result=$this->db->select($sql,$data)){
             foreach($result as $item){
                 $comment=new Comment();
                 $comment->find($item['id']);
                 $comments[]=$comment;
             }
             return $comments;
        }
    }

    function addImages($images){
       $data=array(
            'productId'=>$this->id,
       );       
       $sql='DELETE FROM `product_image` WHERE `product_id`=:productId';
       if($result=$this->db->none_query($sql,$data)){
           $sql='INSERT INTO `product_image`(`product_id`, `image_id`) VALUES (:productId,:imageId)';
            foreach($images as $image){
                $data['imageId']=$image;
                $result=$this->db->none_query($sql,$data);
                if(!$result){
                    return false;
                }
            }
            return true;
        }
        return false;
    }    

    public function deleteImage(Image $image){
        $data=array(
            'imageId'=>$image->id
        );
        $sql='DELETE FROM `product_image` WHERE `image_id`=:imageId';
        if($result=$this->db->none_query($sql,$data)){
            return true;
        }
        return false;
    }

    public function getImages(){
        $images=array();
        $sql='SELECT `image_id` FROM `product_image` WHERE `product_id`=:product_id';
        $data=array(
            'product_id'=>$this->id
        );
        if($result=$this->db->select($sql,$data)){
            foreach($result as $item){
                $image=new Image();
                $image->find($item['image_id']);
                $images[]=$image;
            }
            return $images;
        }
    }


}