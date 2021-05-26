<?php
header('WWW-Authenticate: Basic realm="User Visible Realm", charset="UTF-8"');
include_once($_SERVER['DOCUMENT_ROOT']."/btlweb2/model/userModel.php");
$headers = apache_request_headers();
$role=0;

if(isset($_SERVER['PHP_AUTH_USER'])){

    $auth=[$_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']];
    if(isset($auth[1])){
        $auth["Phone"]=$auth[0];$auth["Password"]=$auth[1];
        
        
        $where = " WHERE ";
        $where=$where."Phone = '".$auth[0]."'";
        $where=$where." AND Password = '".$auth[1]."'";

        $db=new DB();
        $db->connect();
        $result = $db->SeclectData("`user`","ID, Role",$where);
        
        if(!empty($result)){
            $currole= $result[0]["Role"];
            $curid= $result[0]["ID"];
        }else{
            exit('{"error":"lỗi xác thực"}');
        }
    } else{
        exit('{"error":"lỗi xác thực"}');
    }
    
}else {
    exit('{"error":"lỗi xác thực"}');
}
?>