<?php
include_once($_SERVER['DOCUMENT_ROOT']."/websmartphone/config/DB.php");
class userModel extends DB{
    public $ID;
    public $Name;
    public $Email;
    public $Role;
    public $Password;
    public $Phone;
    public $Address;
    
    public function __construct($data = array()){
        foreach ($data as $key => $value){
            $this->$key = $value;
        }
        $this->connect();
    }
    public function getuser(){
        
        $user = array(
            "ID"=>$this->ID,
            "Name" => $this->Name,
            "Email" => $this->Email,
            "Password" =>$this->Password,
            "Phone" =>$this->Phone,
            "Role" => $this->Role,
            "Address" => $this->Address
        );
        return $user;
    }
    public function getAllUser($data){
        $users=[];
        $colum="*";//ID,Name,Email,Role,Phone,Address";
        $where ="";
        $user=new userModel($data);
        $data=$user->getuser();
        
        foreach ($data as $key => $value ){
            if(!strcmp($value,""))  
                unset($data[$key]);
        }
        
        if(!empty($data)){
            $where = "WHERE ";
            if(isset($data["ID"]))
                $where=$where."ID=\"".$data["ID"]."\"";
            if(isset($data["Role"]))
                $where=$where."Role=\"".$data["Role"]."\"";
            if(isset($data["Name"]))
                $where=$where."Name LIKE \"%".$data["Name"]."%\"";
            if(isset($data["Email"]))
                $where=$where."Email LIKE \"%".$data["Email"]."%\"";
            if(isset($data["Phone"]))
                $where=$where."Phone LIKE \"%".$data["Phone"]."%\"";
            if(isset($data["Address"]))
                $where=$where."Address LIKE \"%".$data["Address"]."%\"";

        }
        
        $userlist = $this->SeclectData("user",$colum,$where);
        foreach ($userlist as $user){
            $users[] = new userModel($user);
        }
        return $users ;
    
    }

    public function insertUser(){
        $user=$this->getuser();
        unset($user["ID"]);
        
        if(!isset($this->Address)) unset($user["Address"]);
        if(!$this->Role) unset($user["Role"]);
        foreach ($user as $key => $value ){
            if($value=="")  
            return ["result"=> 0 ,"status"=>"failed"];
        }
        
        if($this->InsertData("user",$user))
            return ["result"=> 1 ,"status"=>"success"];
         else 
             return ["result"=> 0 ,"status"=>"failed"];;
    }
    
    public function editUser(){
        $user=$this->getuser();
        unset($user["ID"]);
        foreach ($user as $key => $value ){
            if($value=="")  
                unset($user[$key]);
        }
        if($this->Role==0) $user["Role"]=$this->Role;
        
        if(empty($this->getAllUser(["ID"=>$this->ID]))) 
            return ["result"=> 0 ,"status"=>"failed"];
        else if($this->UpdateData("user",$this->ID,$user))
            return ["result"=> 1 ,"status"=>"success"];
            else
                return ["result"=> 0 ,"status"=>"failed"];;
    }
    public function deleteUser(){
        if(!isset($this->ID)) 
            return ["result"=> 0 ,"status"=>"failed"];
        else if(empty($this->getAllUser(["ID"=>$this->ID]))) 
            return ["result"=> 0 ,"status"=>"failed"];
        else if($this->DeleteData("user",$this->ID))
                return ["result"=> 1 ,"status"=>"success"];
        else
                return ["result"=> 0 ,"status"=>"failed"];;
    }
}
?>