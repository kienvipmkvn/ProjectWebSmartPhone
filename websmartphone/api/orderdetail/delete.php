<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-With");

    include_once('../../config/db.php');
    include_once('../../model/orderdetail.php');

    $db = new db();
    $connect = $db->connect();

    $orderdetail = new orderdetail($connect);

    $data = json_decode(file_get_contents("php://input"));

    $orderdetail->ID = $data->ID;
    

    if($orderdetail->delete()){
        echo json_encode(array('status','success'));
    }else{
        echo json_encode(array('status', 'failed'));
    }

?>