<?php
    class app{
        protected $root;
        protected $controller="userapi";
        protected $action="";
        protected $params= array();
        
        function __construct(){
            $root=$_SERVER['DOCUMENT_ROOT']."/local_prj";
            $arr = $this->UrlProcess();
            
            // Controller
            if( file_exists("$root/api/".$arr[0]."api.php") ){
                $this->controller = $arr[0]."api";
                unset($arr[0]);
            }
            
            require_once "$root/api/". $this->controller .".php";
            $this->controller = new $this->controller;
            // Action
            if(isset($arr[1])){
                if( method_exists( $this->controller , $arr[1]) ){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }
            echo $this->action;
            // Params
            $this->params = $arr?array_values($arr):array();
            //print_r($this->params);
    }
    
    function UrlProcess(){
        if( isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}
?>