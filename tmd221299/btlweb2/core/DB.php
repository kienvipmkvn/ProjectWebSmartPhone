<?php
class DB{
    public $con=NULL;
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "btlweb";
    public $result=NULL;
    public function __construct(){
        $this->con= mysqli_connect($this->servername, $this->username, $this->password);
        mysqli_select_db($this->con,$this->dbname);
        mysqli_query($this->con,"SET NAMES 'utf-8'" );
    }
    
    public function __destruct(){
        mysqli_close($this->con);
    }
    public function connect(){
        $this->con= mysqli_connect($this->servername, $this->username, $this->password);
        mysqli_select_db($this->con,$this->dbname);
        mysqli_query($this->con,"SET NAMES 'utf-8'" );
    }
    public function execute($sql){
        $this->result=mysqli_query($this->con,$sql );
        return $this->result;
    }
    public function getData(){
        if($this->result){
            $data= mysqli_fetch_array($this->result);
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
            while ($row = $this->result->fetch_assoc()) {
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