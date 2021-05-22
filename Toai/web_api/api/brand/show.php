<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/brand.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $brand = new brand($connect);
    $brand->ID = isset($_GET['id']) ? $_GET['id'] : die();
    
    $brand->show();

    $brand_item = array(
        'ID' => $brand->ID,
        'Name' => $brand->Name,
        'Detail' => $brand->Detail
    );

    print_r(json_encode($brand_item));

?>