<?php

class Db{
    private $hosting='localhost';
    private $db='tea_store';
    private $user='root';
    private $password='root';
    private $charset='utf8';
    public $pdo;

    //функція для зєднання з базою даних
    public function connect(){
        $dsn="mysql:host=$this->hosting;dbname=$this->db;charset=$this->charset";
    $option=[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES=>false,
        ];
        $this->pdo=new PDO($dsn,$this->user,$this->password,$option);
    }

    //функція для формування запитів пошуку
    //повертає об'єкт
    public function select($sql,$array){
        $select=$this->pdo->prepare($sql);
        $select->execute($array);
        return $select->fetchAll();
    }

    //формування заптів для save/update
    //повертає останній id    
    public function query($sql,$data){
        $select=$this->pdo->prepare($sql);
        $select->execute($data);
        return $this->pdo->lastInsertId();
    }

    //Запит для формування Select
    //нічого не повертає
    public function none_query($sql,$data){
        $select=$this->pdo->prepare($sql);
        return $select->execute($data);
    }
}


?>