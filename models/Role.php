<?php
require_once 'Model.php';

class Role extends Model{
    private $id;
    public $name;

    public function find($id){
        $sql="SELECT * FROM `role` WHERE `id`=:id";
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
        
    }

}

?>