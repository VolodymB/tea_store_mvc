<?php
require_once "Model.php";

class User extends Model{
    protected $id;
    public $name;
    public $surname;
    public $email;
    public $login;
    public $password;
    public $role;
    public $error=false;

    public function create($name,$surname,$email,$login,$password){
        if($this->validate($name,$surname,$email,$login,$password)){
            return $this->save();
        }else{
            return false;
        }
    }
    
    public function validate($name,$surname,$email,$login,$password){
        if(!$this->setName($name)){
            return false;
        }
        if(!$this->setSurname($surname)){
            return false;
        }
        if(!$this->setEmail($email)){
            return false;
        }
        if(!$this->setLogin($login)){
            return false;
        }
        if(!$this->setPassword($password)){
            return false;
        }
        return true;
    }

    public function setName($name){
        if(isset($name) && !empty($name)){
            if(mb_strlen($name)>2 && (mb_strlen($name)<50)){
                if(preg_match('#^[a-zA-Z]+$#',$name)){
                    $this->name=$name;
                    return true;
                }else{
                   $this->error['name']= "Можна без цифр будь-ласка name";   
                }
            }else{
                $this->error['name']= "введіть коректне імя";
            }
        }else{
            $this->error['name']= "введіть імя";
        }
        return false;
    }

    public function setSurname($surname){
        if(isset($surname) && !empty($surname)){
            if(mb_strlen($surname)>2 && (mb_strlen($surname)<50)){
                if(preg_match('#^[a-zA-Z]+$#',$surname)){
                    $this->surname=$surname;
                    return true;
                }else{
                    $this->error['surname']="Можна без цифр будь-ласка surname"; 
                     
                }
            }else{
                $this->error['surname']="введіть коректно фамілію";
                
            }
        }else{
            $this->error['surname']="введіть фамілію";            
        }
        return false;
    }

    public function setEmail($email){
       if(isset($email) && !empty($email)){
            if(strstr($email,'@')){
                $this->email=$email;
                return true; 
            }else{
                $this->error['email']='введіть коретктний email';
            }
       }else{
           $this->error['email']='введіть email';
           
       }
       return false;
    }

    public function setLogin($login){
        if(isset($login) && !empty($login)){
            if(mb_strlen($login)>=2 && mb_strlen($login)<50){
                $sql="SELECT `login` FROM `user` WHERE `login`=:newLogin";
                $data=array(
                    'newLogin'=>$login
                );
                if(!$result=$this->db->select($sql,$data)){
                    $this->login=$login;
                    return true;
                }else{
                    $this->error['login']='Оберіть інший Login';                    
                }
            }else{
                $this->array['login']='Оберіть довший Login';
                
            }
        }else{
            $this->error['login']='введіть ваш login';
            
        }
        return false;
    }

    public function setPassword($password){
        if(isset($password) && !empty($password)){
            if(mb_strlen($password)>=2 && mb_strlen($password)<50){
                $this->password=$password;
                return true;
            }else{
                $this->error['password']='оберіть довший пароль';                
            }
        }else{
            $this->error['password']='Оберіть свій пароль';            
        }
       return false; 
    }

    public function find($id){
        $sql="SELECT * FROM `user` WHERE `id`=:id";
        $data=array(
            'id'=>$id
        );
        if($result=$this->db->select($sql,$data)){
            $this->id=$result[0]['id'];
            $this->name=$result[0]['name'];
            $this->surname=$result[0]['surname'];
            $this->email=$result[0]['email'];
            $this->login=$result[0]['login'];
            $this->password=$result[0]['password'];
            $this->role=$this->getRole();
            return true;
        }
        return false;
    }

    public function save(){
        $data=array(
            'username'=>$this->name,
            'surname'=>$this->surname,
            'email'=>$this->email,
            'userlogin'=>$this->login,
            'userpassword'=>$this->password
        );
        if(is_null($this->id)){
            $sql="INSERT INTO `user`(`name`, `surname`, `email`, `login`, `password`) VALUES (:username,:surname,:email,:userlogin,:userpassword)";            
        }else{
            $sql='UPDATE `user` SET `name`=:username,`surname`=:surname,`email`=:email,`login`=:userlogin,`password`=:userpassword WHERE `id`=:id';
            $data['id']=$this->id;
        }
        if($result=$this->db->query($sql,$data)){
            $this->id=$result;
            return true;
        }
        return false;
    }

    //всі коментарі від користувача
    public function getComments(){
        $comments=array();
        $data=array(
            'userId'=>$this->id
        );
        $sql="SELECT * FROM `comment` WHERE `user_id`=:userId";
        if($result=$this->db->select($sql,$data)){
            foreach($result as $item){
                $comment=new Comment();
                $comment->find($item['id']);
                $comments[]=$comment;
            }
            return $comments;
        }
    }

    //авторизація 
    public function login($email,$login,$password){
        //перевірка чи існує користувач
        //якщо існує, авторизація
        //не існує переведення на поле реєстраціїї
        //SELECT `id` FROM `user` WHERE `email`=,`login`=,`password`=
        $sql="SELECT `id` FROM `user` WHERE `email`=:email AND `login`=:userLogin AND `password`=:userPassword";
        $data=array(
            'email'=>$email,
            'userLogin'=>$login,
            'userPassword'=>$password
        );
        if($result=$this->db->select($sql,$data)){
            return $result[0]['id'];
        }

    }

    public function getRole(){
        $sql="SELECT rol.`name` as 'role_name' FROM `user_role` us_role  LEFT JOIN `role` rol  ON us_role.`role_id`=rol.`id`  WHERE `user_id`=:userId";
        $data=array(
            'userId'=>$this->id
        );
        if($result=$this->db->select($sql,$data)){
            return $result[0]['role_name'];
        }
    }


}

?>