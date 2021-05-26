<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/orderdetail.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $orderdetail = new orderdetail($connect);
    $read = $orderdetail->read();

    $num = $read->rowCount();

    if($num > 0){
        $orderdetail_array = [];
        $orderdetail_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $orderdetail_item = array(
                'ID' => $ID,
                'OrderID' => $OrderID,
                'ProductID' => $ProductID,
                'Quantity' => $Quantity
            );
            array_push($orderdetail_array['data'], $orderdetail_item);
        }
        echo json_encode($orderdetail_array);
    }

?>