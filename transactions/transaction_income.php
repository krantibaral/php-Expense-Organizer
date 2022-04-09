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
  $json = file_get_contents('php://input');
  $obj = json_decode($json, true);
 
 
  $sql = "SELECT Amount, Category, Date, Description, Type FROM addincome UNION SELECT Amount, Category, Date, Description, Type From addexpense";
       $result = mysqli_query($con, $sql);
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

 // break;
 // //Update transactions
 // case 'PUT':
 //  $json = file_get_contents('php://input');
 //  $date = json_decode($json, true);

 //  if (is_null($data)){
 //      $response = array(
 //          'status' => false,
 //          'msg' => 'Empty Fields'
 //      );
 //      echo json_encode($response);
 //      
 //  }else{
 //      $sql = "UPDATE "
 //  }

       
      
   
  
  
  ?>