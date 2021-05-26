<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/orders.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $orders = new orders($connect);
    $orders->ID = isset($_GET['id']) ? $_GET['id'] : die();
    
    $orders->show();

    $orders_item = array(
        'ID' => $orders->ID,
        'Name' => $orders->Name,
        'UserPhone' => $orders->UserPhone,
        'UserAddress' => $orders->UserAddress,
        'UserID' => $orders->UserID,
        'Amount' => $orders->Amount,
        'Note' => $orders->Note
    );

    print_r(json_encode($orders_item));

?>