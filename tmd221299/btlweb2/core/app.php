<?php
class App{
    
    protected $controller="Home";
    protected $action="SayHi";
    protected $params= array();
    
    function __construct(){
        
        $arr = $this->UrlProcess();
        
        // Controller
        if( file_exists("./controller/".$arr[0].".php") ){
            $this->controller = $arr[0];
            unset($arr[0]);
        }
        
          require_once "./controller/". $this->controller .".php";
          
         $this->controller = new $this->controller;
         $this->controller->show();
         
        // Action
        if(isset($arr[1])){
            if( method_exists( $this->controller , $arr[1]) ){
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }
        //echo $action;
        // Params
         $this->params = $arr?array_values($arr):array();
         //print_r($this->params);
       // print_r($this->params);
        //call_user_func_array(array($this->controller, $this->action), $this->params );
    }
    
    function UrlProcess(){
        if( isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
    public function Sayst(){
        echo "this is say st function";
        
    }
    
}
?>