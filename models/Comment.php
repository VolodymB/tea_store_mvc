<?php
require_once "Model.php";
class Comment extends Model{
    private $id;
    public $user_id;
    public $comment;
    public $raiting;
    public $product_id;
    public $user;
    public $product;

    public function find($id){
        $sql="SELECT * FROM `comment` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        if($result=$this->db->select($sql,$data)){
            $this->id=$result[0]['id'];
            $this->user_id=$result[0]['user_id'];
            $this->comment=$result[0]['comment'];
            $this->raiting=$result[0]['raiting'];
            $this->product_id=$result[0]['product_id'];
            //Отримання інфо про User
            $this->user=$this->getUser();
            //Інфо про товар
            $this->product=$this->getProduct();
            return true;
        }
        return false;
    }

    public function save(){
        $data=array(
            'userId'=>$this->user_id,
            'comment'=>$this->comment,
            'raiting'=>$this->raiting,
            'productId'=>$this->product_id
        );
        if(is_null($this->id)){
            //INSERT INTO `comment`(`user_id`, `comment`, `raiting`, `product_id`) VALUES ([value-2],[value-3],[value-4],[value-5])
            $sql='INSERT INTO `comment`(`user_id`, `comment`, `raiting`, `product_id`) VALUES (:userId,:comment,:raiting,:productId)';
        }else{
            $sql='UPDATE `comment` SET `user_id`=:userId,`comment`=:comment,`raiting`=:raiting,`product_id`=:productId WHERE `id`=:id';
            $data['id']=$this->id;
        }
        if($result=$this->db->query($sql,$data)){
            $this->id=$result;
            return true;
        }
        return false;
    }


    public function getUser(){
        //Новий екземпляр класу
        $user= new User();
        $user->find($this->user_id);
        //застосування функції із внесеним значенням властивості 
        $user->find($this->user_id);
        //повертається $user
        return $user;
    }

    public function getProduct(){
        $product=new Product();
        $product->find($this->product_id);
        return $product;
    }



}



?>