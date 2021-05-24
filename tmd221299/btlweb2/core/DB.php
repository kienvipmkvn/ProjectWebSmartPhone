<?php
class DB{
    public $con=NULL;
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "btlweb";
    public $result=NULL;
    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "ket noi thanh cong";
        }
        catch(PDOException $e){
            echo "ket noi that bai " . $e->getMessage();
        }
        return $this->conn;
    }
    
    public function __destruct(){
        $this->con=NULL;
        $this->result=NULL;
    }
    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "ket noi thanh cong";
        }
        catch(PDOException $e){
            echo "ket noi that bai " . $e->getMessage();
        }
        return $this->conn;
    }
    public function execute($sql){
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        $this->result=$stmt;
        return $this->result;
    }
    public function getData(){
        if($this->result){
            $data= $this->result->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            $data=0;
        }
       
        return $data;
    }
    public function getAllData(){
        $data=[];
        if(!$this->result){
            return [];
        }else{
            while ($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
                $data[]=$row;
            }
        }
        
        return $data;
    }
    public function SeclectData($tableName,$colum="*",$where=""){
         $sql="SELECT $colum FROM $tableName
                    $where";
         
         $this->execute($sql);
         return $this->getAllData();
    }
    public function InsertData($tableName,$data = []){
        $keysql="";$valuesql="";
        //print_r($data);
        foreach ($data as $key => $value){
            $keysql=$keysql.$key;
            $valuesql=$valuesql."'$value'";
            if(strcmp(next($data),"")) {
                $keysql=$keysql.",";
                $valuesql="$valuesql,";
            }
        }
        $sql="INSERT INTO $tableName ($keysql)
                VALUES ($valuesql)";
        
        return $this->execute($sql);
    }
    public function UpdateData($tableName,$id,$data = []){
        $updateQuery="";
        foreach ($data as $key => $value){
            $updateQuery=$updateQuery."$key = \"$value\"";
            if(strcmp(next($data),"")) {
                $updateQuery=$updateQuery.",";
            }
        }
        $sql="Update $tableName
        Set $updateQuery
        Where ID=$id";
        
        return ($this->execute($sql));
    }
    public function DeleteData($tableName,$id){
        
        $sql="DELETE FROM $tableName
        Where ID=$id";
        
       return ($this->execute($sql)) ;
    }
}