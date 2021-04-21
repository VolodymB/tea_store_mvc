<?php
require_once "Model.php";

class Image extends Model{
    public $id;
    public $image;

    public function find($id){
        $sql="SELECT * FROM `image` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        if($result=$this->db->select($sql,$data)){
            $this->id=$result[0]['id'];
            $this->image=$result[0]['image'];
            return true;
        }
        return false;
    }

    // надаємо значення властивості name і додаємо в файл
    public function setImage(array $file){
        //проверяем загужен ли файл и загружен без ошибок
        if (isset($file)&& $file['error']===UPLOAD_ERR_OK){
        
            //переносим наш файл из временной папки tmp_name в нашу папку img/ и взяли его название
            $name=$file['name'];
            if(move_uploaded_file($file['tmp_name'],'img/'.$name)){
                $this->image = 'img/'.$name;
                return true;   
            } 
        }
    }

    public function save(){
        $data=array(
            'imagename'=>$this->image
        );
        if(is_null($this->id)){
            $sql="INSERT INTO `image`(`image`) VALUES (:imagename)";//1              
        }else{
            $sql="UPDATE `image` SET `image`=:imagename WHERE `id`=:id";//1
            $data['id']=$this->id;            
        }
        if($result=$this->db->query($sql,$data)){
            $this->id=$result;    
            return true;
            }
            return false;  
    }
    
    public function getList(){
        $data=array();
        $sql="SELECT * from `image`";
        if($result=$this->db->select($sql,$data)){
            return $result;
        }
        return false;
    }

    public function getProductIdByImage(){
        $data=array(
            'image_id'=>$this->id
        );
        $sql='SELECT `product_id` FROM `product_image` WHERE `image_id`=:image_id';
        $products=array();
        if($result=$this->db->select($sql,$data)){
            return $result;
        }
        return false;
    }

    public function delete(){
        $data=array(
            'id'=>$this->id
        );
        $sql='DELETE FROM `image` WHERE `id`=:id';
        if($result=$this->db->none_query($sql,$data)){
            $this->deleteFile();
            return true;
        }
        return false;
    }

    public function deleteFile(){
        if(file_exists($this->image)){
            unlink($this->image);
        }
    }



}


?>