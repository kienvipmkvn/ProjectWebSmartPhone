<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/websmartphone";
    include_once("$root/model/userModel.php");
    include_once("$root/config/DB.php");
    class User {
        public $db;
        public $data =[];
        
        public function __construct(){
            $this->db = new DB();
        }
        
        public function getUserList($data)
        {
            if(isset($data["id"]))$data["ID"]=$data["id"];
            $colum="ID,Name,Email,Role,Phone,Address";
            $thisuser=new userModel($data);

            $this->data=$thisuser->getAllUser($data);
            return $this->data ;
        }
        
        public function insertUser($data){
            $newuser=new userModel($data);
            return $newuser->insertUser();
        }
        
        public function editUser($id,$data){
            $data["ID"]=$id;
            $newuser=new userModel($data);
            return $newuser->editUser();
        }
        
        public function deleteUser($id){
            $data["ID"]=$id;
            $deluser=new userModel($data);
            return $deluser->deleteUser();
        }
    }
?>
