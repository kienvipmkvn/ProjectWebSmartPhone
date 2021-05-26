<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/orders.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $orders = new orders($connect);
    $orders->Name = isset($_GET['name']) ? $_GET['name'] : die();

    $read = $orders->statussearch();

    $num = $read->rowCount();

    if($num > 0){
        $orders_array = [];
        $orders_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $orders_item = array(
                'ID' => $ID,
                'Name' => $Name,
                'UserPhone' => $UserPhone,
                'UserAddress' => $UserAddress,
                'UserID' => $UserID,
                'Amount' => $Amount,
                'Note' => $Note,
                'Status' => $Status
            );
            array_push($orders_array['data'], $orders_item);
        }
        echo json_encode($orders_array);
    }

?>
