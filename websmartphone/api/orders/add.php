<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-With");

include_once('../../config/db.php');
include_once('../../model/orders.php');

$db = new db();
$connect = $db->connect();

$orders = new orders($connect);

$data = json_decode(file_get_contents("php://input"));

$orders->Name = $data->Name;
$orders->UserPhone = $data->UserPhone;
$orders->UserAddress = $data->UserAddress;
$orders->Amount = $data->Amount;
$orders->Note = $data->Note;
$orders->Status = $data->Status;

$result = $orders->add();
$errorMess=["status"=>"faid"];
$mess=["Guid"=>$result];
if ($result) {
    echo json_encode($mess,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode($errorMess,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}

?>