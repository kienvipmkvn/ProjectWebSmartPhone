<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/orderdetail.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $orderdetail = new orderdetail($connect);
    $orderdetail->ID = isset($_GET['id']) ? $_GET['id'] : die();
    
    $orderdetail->show();

    $orderdetail_item = array(
        'ID' => $orderdetail->ID,
        'OrderID' => $orderdetail->OrderID,
        'ProductID' => $orderdetail->ProductID,
        'Quantity' => $orderdetail->Quantity,
    );

    print_r(json_encode($orderdetail_item));

?>