<?php
include_once($_SERVER['DOCUMENT_ROOT']."/btlweb2/core/DB.php");
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
       // $this->Role=(int)$this->Role;
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
        //print_r($data);
        foreach ($data as $key => $value ){
            if(!strcmp($value,""))  //echo json_encode(["messenger"=>"thêm user thất bại"]);
                unset($data[$key]);
        }
       // print_r($data);
       // echo isset($data["ID"]);
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
        //  echo $where;
        //print_r($data); echo $where;
        $userlist = $this->SeclectData("user",$colum,$where);
        //print_r($userlist);
        foreach ($userlist as $user){
            $users[] = new userModel($user);
        }
        
        //echo json_encode($this->data,JSON_PRETTY_PRINT);
        return $users ;
    
    }

    public function insertUser(){
        $user=$this->getuser();
        unset($user["ID"]);
        //print_r($user);
        if(!isset($this->Address)) unset($user["Address"]);
        if(!$this->Role) unset($user["Role"]);
        foreach ($user as $key => $value ){
            if($value=="")  //echo json_encode(["messenger"=>"thêm user thất bại"]);
            return ["result"=> 0 ,"messenger"=>"thêm user thất bại, thiếu thông tin"];
        }
        if($this->InsertData("user",$user))
            return ["result"=> 1 ,"messenger"=>"Thêm user thành công"];
         else 
             return ["result"=> 0 ,"messenger"=>"Thêm user thất bại"];;
    }
    
    public function editUser(){
        $user=$this->getuser();
        unset($user["ID"]);
        foreach ($user as $key => $value ){
            if($value=="")  //echo json_encode(["messenger"=>"thêm user thất bại"]);
                unset($user[$key]);
        }
        if($this->Role==0) $user["Role"]=$this->Role;
        //return $this->UpdateData("user",$this->ID,$user);
        if(empty($this->getAllUser(["ID"=>$this->ID]))) 
            return ["result"=> 0 ,"messenger"=>"user Không tồn tại"];
        else if($this->UpdateData("user",$this->ID,$user))
            return ["result"=> 1 ,"messenger"=>"Sửa thông tin user thành công"];
            else
                return ["result"=> 0 ,"messenger"=>"Sửa thông tin user thất bại"];;
    }
    public function deleteUser(){
        if(!isset($this->ID)) 
            return ["result"=> 0 ,"messenger"=>"Chưa nhập id user cần xóa"];
        else if(empty($this->getAllUser(["ID"=>$this->ID]))) 
            return ["result"=> 0 ,"messenger"=>"user Không tồn tại"];
        else if($this->DeleteData("user",$this->ID))
                return ["result"=> 1 ,"messenger"=>"Xóa user thành công"];
        else
                return ["result"=> 0 ,"messenger"=>"Xóa user thất bại"];;
    }
}
//$test = new user();
//print_r($test->getuser());
?>