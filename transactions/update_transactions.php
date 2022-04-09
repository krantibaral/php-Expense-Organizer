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
 if (is_null($data)){
     $response = array(
         'status' => false,
         'msg' => 'Empty Fields'
     );
     echo json_encode($response);
    }else{
        $sql = "UPDATE addincome SET Amount = ?, Category = ?, Date = Now(),  Description = ? WHERE id =?";
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $data->Amount, $data->Category,  $data->Description, $data->id);
            mysqli_stmt_execute($stmt);
            $response = array(
                'status' =>true,
                'msg' => "Updated Successfully"

            );
            echo json_encode($response);
        }else{
            $response = array(
                'status' =>fasle,
                'msg' => "Error Preparing Statements"

            );
            echo json_encode($response);
        }
    }
 
 
  
  