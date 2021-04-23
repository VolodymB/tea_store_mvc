<?php
require_once "Model.php";

class StatusProduct extends Model{
    public $id;
    public $name;

    public function find($id){
        $sql="SELECT * FROM `status_product` WHERE `id`=:id";
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
            $sql="INSERT INTO `status_product`(`name`) VALUES (:unitname)";            
        }else{
            $sql="UPDATE `status_product` SET `name`=:unitname WHERE `id`=:id";
            $data['id']=$this->id;
        }       
            if($result=$this->db->query($sql,$data)){
                $this->id=$result;
                return true;
            }
            return false;        
    }

    //перелік всіх статусів
    public function getList(){
        //простий запит без піготовлених позицій
        $sql="SELECT * FROM `status_product`";
            $data=array(

            );
            if($result=$this->db->select($sql,$data)){
                return $result;                
            }
    }
}
?>