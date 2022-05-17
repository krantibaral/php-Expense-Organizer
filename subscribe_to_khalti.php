<?php
header('Access-Control-Request-Headers: Content-Type');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$HostName = "localhost";

$DatabaseName = "kranti";

$HostUser = "root";

$HostPass = "";

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

$json = file_get_contents('php://input');

$obj = json_decode($json, true);

$userid = $obj['userid'] ;

$sql_query = "Update users set subscribed = 1 where id = $userid";

if(mysqli_query($con,$sql_query)){
    echo json_encode(['status' => 'success']) ;
}
else{
    echo json_encode(['status' => 'fail', "error" => mysqli_error($con)]) ;
}
mysqli_close($con);
?>


