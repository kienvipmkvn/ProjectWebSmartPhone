<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/product.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $product = new product($connect);
    $product->ID = isset($_GET['id']) ? $_GET['id'] : die();
    
    $product->show();

    $product_item = array(
        'ID' => $product->ID,
        'Name' => $product->Name,
        'Detail' => $product->Detail,
        'Price' => $product->Price,
        'Image' => $product->ImageLink,
        'BrandID' => $product->BrandID
    );

    print_r(json_encode($product_item));

?>