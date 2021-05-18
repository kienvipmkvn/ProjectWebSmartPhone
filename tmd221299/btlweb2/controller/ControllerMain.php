<?php
//include_once("model/ModelMain.php");

class Controller {
    public $model;
    
   // public function __construct()
   // {
        //$this->model = new Model();
        
    //}
    public function model($model,$datamodel=array())
    {
        include_once("./model/".$model.".php");
        return new $model("a","b","c","d");
    }
    
    public function invoke()
    {
        //include 'view/lockerview.html';
         $_GET["URL"];
        echo "aaaa";
    }
    public function view($view,$data=[])
    {
        include $_SERVER['DOCUMENT_ROOT']."/local_prj/view/$view.php";
    }
}


?>