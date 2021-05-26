<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/orders.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $orders = new orders($connect);
    $orders->ID = isset($_GET['id']) ? $_GET['id'] : die();
    $orders->ID = ($orders->ID-1)*10;

    $read = $orders->read();

    $num = $read->rowCount();

    if($num > 0){
        $order_array = [];
        $order_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $order_item = array(
                'ID' => $ID,
                'Name' => $Name,
                'UserPhone' => $UserPhone,
                'UserAddress' => $UserAddress,
                'UserID' => $UserID,
                'Amount' => $Amount,
                'Note' => $Note,
                'Status' => $Status
            );
            array_push($order_array['data'], $order_item);
        }
        echo json_encode($order_array);
    }

?>