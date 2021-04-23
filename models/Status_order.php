<?php
require_once "model.php";

class StatusOrder extends Model{
    public $id;
    public $name;

    public function find($id){
        $sql="SELECT * FROM `status_order` WHERE `id`=:id";
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
            'statusname'=>$this->name
        );
        if(is_null($this->id)){
            $sql="INSERT INTO `status_order`(`name`) VALUES (:statusname)";
        }else{
            $sql="UPDATE `status_order` SET `name`=:statusname WHERE `id`=:id";
            $data['id']=$this->id;
        }
        if($result=$this->db->query($sql,$data)){
            $this->id=$result;
            return true;
        }
        return false;

    }
}
?>