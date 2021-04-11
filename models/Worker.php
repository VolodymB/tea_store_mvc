<?php
require_once "User.php";
class Worker extends User{
    public $user_id;
    public $role_id;
    public $worker_id;

    public function find($worker_id){
        $sql="SELECT * FROM `user_role` WHERE `id`=:id";
        $data=array(
            'id'=>$worker_id
        );
        if($result=$this->db->select($sql,$data)){
            $this->worker_id=$result[0]['id'];
            $this->user_id=$result[0]['user_id'];
            $this->role_id=$result[0]['role_id'];
            parent::find($this->user_id);           
            return true;
        }
        return false;
       
    }

    public function save(){
        parent::save();        
        $data=array(
            'userId'=>$this->id,
            'role_id'=>$this->role_id
        );
        if(is_null($this->worker_id)){
            $sql='INSERT INTO `user_role`( `user_id`, `role_id`) VALUES (:userId,:role_id)';
        }else{
            $sql="UPDATE `user_role` SET `user_id`=:userId,`role_id`=:role_id WHERE `id`=:worker_id";
            $data['worker_id']=$this->worker_id;
        }
        if($result=$this->db->query($sql,$data)){
            $this->worker_id=$result;
            $this->user_id = $id;
            return true;
        }
        return false;
            
    }


}


?>