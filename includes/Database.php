<?php

class Database{
    
    public $pdo;
    public $stmt;

    public function __construct($db='church',$host = "localhost:3310",$user='root',$pwd=''){
        try{
            $this->pdo = new PDO("mysqlhost:host=$host;dbname=$db",$user,$pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Connection failed : ".$e->getMessage();
        }
    }

   public function run($query, $params = null)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
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

