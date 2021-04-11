<?php


// use config\Db;
require_once "config/db.php";

abstract class Model{
    public $db;

    public function __construct(){
        $this->db=new Db();
        $this->db->connect();
    }

    public abstract function find($id);

    public abstract function save();    
    
}
?>