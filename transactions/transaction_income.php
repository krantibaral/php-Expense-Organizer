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
 
  //$sql = "SELECT * FROM addexpense";
  //$sql = "SELECT * FROM addincome";
  $sql = "SELECT Amount, Category, Date, Type FROM addincome UNION SELECT Amount, Category, Date, Type From addexpense";
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
       
      
   
  
  
  ?>