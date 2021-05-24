<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

    $root=$_SERVER['DOCUMENT_ROOT']."/websmartphone";
    include_once "$root/controller/User.php";
    
    class userapi{
        public $controller;
        public $users=[];
        public function  __construct(){
            $this->controller=new User();
            switch ($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $this->getuser();
                    break;
                case "POST":
                    $this->insertuser();
                    break;
                case "PUT":
                    $this->updateuser();
                    break;
                case "DELETE":
                    $this->deleteuser();
                    break;
                default:
                        echo "method không hợp lệ";
            }
        }
        public function __destruct(){
            
        }
        
        public function getuser(){
            $str = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
            parse_str($str, $output);
            $params=array_change_key_case($output, CASE_UPPER);
            $output[]=$params;
            
            $userlist=$this->controller->getUserList($output);
            foreach ($userlist as $user){
                $this->users[]=$user->getuser();
            }
            
            echo json_encode($this->users,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
        
        public function insertuser(){
            $input = json_decode(file_get_contents('php://input'),true);
            echo json_encode($this->controller->insertUser($input),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE );
        }
        
        public function deleteuser(){
            $str = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
            parse_str($str, $params);
            $params=array_change_key_case($params, CASE_UPPER);
            
            echo json_encode($this->controller->deleteUser($params["ID"]),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE );
            
        }
        
        public function updateuser(){
            $str = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
            parse_str($str, $params);
            $input = json_decode(file_get_contents('php://input'),true);
            $params=array_change_key_case($params, CASE_UPPER);
            
            echo json_encode($this->controller->editUser($params["ID"],$input),JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE );
        }
        
    }
    $userapi= new userapi();
?>