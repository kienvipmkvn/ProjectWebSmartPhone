<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/btlweb2";
    include_once("$root/model/userModel.php");
    include_once("$root/core/DB.php");
    include_once("$root/controller/ControllerMain.php");
    class User extends Controller{
        public $db;
        public $data =[];
        //public $thisuser;
        public function __construct(){
            $this->db = new DB();
        }
        public function getUserList($data)
        {
            if(isset($data["id"]))$data["ID"]=$data["id"];
            $colum="ID,Name,Email,Role,Phone,Address";
            $thisuser=new userModel($data);
            /*$userlist = $this->db->SeclectData("user",$colum,$data);
            //print_r($userlist);
            foreach ($userlist as $user){
                $this->data[] = new userModel($user);
            }
            */
            //echo json_encode($this->data,JSON_PRETTY_PRINT);
            $this->data=$thisuser->getAllUser($data);
            return $this->data ;
        }
        public function show(){
            $this->view("user");
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
