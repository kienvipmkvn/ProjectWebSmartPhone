<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-With");

    include_once('../../config/db.php');
    include_once('../../model/product.php');

    $db = new db();
    $connect = $db->connect();

    $product = new product($connect);

    $data = json_decode(file_get_contents("php://input"));

    $product->ID = $data->ID;
    $product->Name = $data->Name;
    $product->Detail = $data->Detail;
    $product->Price = $data->Price;
    $product->ImageLink = $data->Image;
    $product->BrandID = $data->BrandID;

    if($product->update()){
        echo json_encode(array('message','update thanh cong'));
    }else{
        echo json_encode(array('message', 'update that bai'));
    }

?>