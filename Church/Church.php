<?php

include_once "./includes/Database.php";


class Church{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function AddUser($name,$age,$email,$phonenumber){
        $sql = "INSERT INTO users(name,age,email,phonenumber) VALUES(:name,:age,:email,:phonenumber)";
        $param = [
            ":name"=>$name,
            ":age"=>$age,
            ":email"=>$email,
            "phonenumber"=>$phonenumber
        ];
        return $this->db->run($sql,$param);
    }
    
    


}



?>