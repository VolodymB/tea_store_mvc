<?php
require_once "Model.php";

class User extends Model{
    protected $id;
    public $name;
    public $surname;
    public $email;
    public $login;
    public $password;
    public $error=false;

    public function create($name,$surname,$email,$login,$password){
        if($error=$this->validate($name,$surname,$email,$login,$password)){
            echo 'ok';
            // return $this->save();
        }else{
            return $error;
        }
    }
    
    public function validate($name,$surname,$email,$login,$password){
        if(!$this->setName=$name){
            return false;
        }
        if(!$this->setSurname=$surname){
            return false;
        }
        if(!$this->setEmail=$email){
            return false;
        }
        if(!$this->setLogin=$login){
            return false;
        }
        if(!$this->setPassword=$password){
            return false;
        }
        return true;
    }

    public function setName($name){
        if(isset($name) && !empty($name)){
            if(mb_strlen($name)>2 && (mb_strlen($name)<50)){
                if(preg_match('#^[a-z][A-Z]$#')){
                    $this->name=$name;
                }else{
                   echo "Можна без цифр будь-ласка";   
                }
            }else{
                echo "введіть коректне імя";
            }
        }else{
            echo "введіть імя";
        }
        return true;
    }

    public function setSurname($surname){
        if(isset($surname) && !empty($surname)){
            if(mb_strlen($surname)>2 && (mb_strlen($surname)<50)){
                if(preg_match('#^[a-z][A-Z]$#')){
                    $this->surname=$surname;
                }else{
                    $this->error="Можна без цифр будь-ласка"; 
                    return false;  
                }
            }else{
                $this->error="введіть коректно фамілію";
                return false;
            }
        }else{
            $this->error="введіть фамілію";
            return false;
        }
        return true;
    }

    public function setEmail($email){
       if(isset($email) && !empty($email)){
            if(strstr($email,'@')){
                $this->email=$email;
            }else{
                $this->error='введіть коретктний email';
            }
       }else{
           $this->error='введіть email';
           return false;
       }
       return true; 
    }

    public function setLogin(){
        if(isset($login) && !empty($login)){
            if(mb_strlen($login)>=2 && mb_strlen($login)<50){
                $sql="SELECT `login` FROM `user` WHERE `login`=:newLogin";
                $data=array(
                    'newLogin'=>$this->login
                );
                if(!$result=$this->db->select($sql,$data)){
                    $this->login=$login;
                }else{
                    $this->erro='Оберіть інший Login';
                    return false;
                }
            }else{
                $this->array='Оберіть довший Login';
                return false;
            }
        }else{
            $this->error='введіть ваш login';
            return false;
        }
        return true;
    }

    public function setPassword(){
        if(isset($password) && !empty($password)){
            if(mb_strlen($login)>=2 && mb_strlen($login)<50){
                $this->password=$password;
            }else{
                $this->error='оберіть довший пароль';
            }
        }else{
            $this->error='Оберіть свій пароль';
            return false;
        }
        return true;
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


}

?>