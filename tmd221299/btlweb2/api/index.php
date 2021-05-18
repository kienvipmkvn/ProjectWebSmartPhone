<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

    include_once 'app.php';
    if(isset($_GET["url"])){
        $app=new app();
    }
    else echo "access denied";
?>