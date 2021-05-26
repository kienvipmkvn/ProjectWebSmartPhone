<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/orders.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $orders = new orders($connect);
    $pageIndex = isset($_GET['pageIndex']) ? $_GET['pageIndex'] : 1;
    $pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 1;
    $pageIndex = ($pageIndex-1)*$pageSize;

    $read = $orders->read($pageIndex, $pageSize);

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