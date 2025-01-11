<?php

class Database{
    
    public $db;
    public $stmt;

    public function __construct($db='church',$user='root',$pwd='',$host="localhost:3310"){
        try{
            $this->db = new PDO("mysqlhost:host=$host;dbname=$db",$user,$pwd);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            echo "Succesffully connected";
        }
        catch(PDOException $e){
            echo "Connection failed : ".$e->getMessage();
        }
    }

   public function run($query, $params = null)
    {
        try {
            $this->stmt = $this->db->prepare($query);
            if ($params !== null) {
                $this->stmt->execute($params);
            } else {
                $this->stmt->execute();
            }
            return $this->stmt; 
        } catch (PDOException $e) {
            echo "Execution error: " . $e->getMessage();
            return false;
        }
    }

    
}

?>


<?php
try {
    $pdo = new PDO("mysql:host=localhost:3310;dbname=church", "root", "");
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

