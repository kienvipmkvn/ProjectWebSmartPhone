<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/brand.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $brand = new brand($connect);
    $read = $brand->read();

    $num = $read->rowCount();

    if($num > 0){
        $brand_array = [];
        $brand_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $brand_item = array(
                'ID' => $ID,
                'Name' => $Name,
                'Detail' => $Detail
            );
            array_push($brand_array['data'], $brand_item);
        }
        echo json_encode($brand_array);
    }

?>