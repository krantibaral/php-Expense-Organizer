<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Accept: application/json");

$method =$_SERVER['REQUEST_METHOD'];

$response = array(
    'status' => $method,

);

echo json_encode($response);
require 'db.php';

switch ($method){
    case 'GET':
     $sql = "SELECT * FROM addincome";
     $result = mysqli_query($conn, $sql);
     $tasks = array();
     if(mysqli_num_rows($result)>0){
         while($row = mysqli_fetch_assoc($result)){
             array_push($tasks, $row);
         }

         $response = array(
             'status' => true,
             'msg' => "Fetched Sucessfully",
             'data' => $tasks,
         );
         echo json_encode($response);

    
        }else{
         $response = array(
             'status' => false,
             'msg' => "No Transactions Found",
         );
         echo json_encode($response);
     }
     break; 

     case 'POST':
        $dat

}
?>