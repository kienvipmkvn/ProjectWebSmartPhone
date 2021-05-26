<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/product.php');

    $dtb = new db();
    $connect = $dtb->connect();

    $product = new product($connect);
    $Id = isset($_GET['id']) ? $_GET['id'] : die();
    $size = isset($_GET['size']) ? $_GET['size'] : die();
    $Id = ($Id-1)*$size;

    $read = $product->read($Id, $size);

    $num = $read->rowCount();

    if($num > 0){
        $product_array = [];
        $product_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $product_item = array(
                'ID' => $ID,
                'Name' => $Name,
                'Detail' => $Detail,
                'Price' => $Price,
                'Image' => $ImageLink,
                'BrandID' => $BrandID
            );
            array_push($product_array['data'], $product_item);
        }
        echo json_encode($product_array);
    }

?>
