<?php
class DB{
    
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "btlweb";
    private $result=NULL;
    
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname."", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this->conn;
    }
    
}
?>
