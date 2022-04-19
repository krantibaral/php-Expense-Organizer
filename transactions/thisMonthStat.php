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

$sql_query = "select * from transactions where MONTH(trn_date) = MONTH(CURRENT_DATE()) AND YEAR(trn_date) = YEAR(CURRENT_DATE()) AND userid = $userid";

if( $res = mysqli_query($con,$sql_query)){
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC) ;
    echo json_encode(['status' => 'success', 'transactions' => $data]) ;
}
else{
    echo json_encode(['status' => 'fail', "error" => mysqli_error($con)]) ;
}
mysqli_close($con);
?>



