<?php 
header('Access-Control-Request-Headers: Content-Type');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

  $HostName = "localhost";
  $DatabaseName = "kranti";
  $HostUser = "root";
  $HostPass = "";
  //creating mysql connection
  $con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
  //storing the recived json into $json variable
$data = json_decode(file_get_contents("php://input"));

if(is_null($data)){
    $response = array(
        'status' => false,
        'msg' => "Empty fields",
    );
    header("HTTP/1.1 400");
    echo json_encode($response);

}else{
    $sql = "DELETE FROM addincome WHERE id = " .$data->id;
    $result = mysqli_query($con, $sql);
    $response = array(
        "status" => true,
        'msg' => "Deleted Successfully"
    );
    echo json_encode($response);
}
?>