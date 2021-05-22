<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-With");

    include_once('../../config/db.php');
    include_once('../../model/brand.php');

    $db = new db();
    $connect = $db->connect();

    $brand = new brand($connect);

    $data = json_decode(file_get_contents("php://input"));

    $brand->ID = $data->ID;
    $brand->Name = $data->Name;
    $brand->Detail = $data->Detail;

    if($brand->update()){
        echo json_encode(array('message','update thanh cong'));
    }else{
        echo json_encode(array('message', 'update that bai'));
    }

?>