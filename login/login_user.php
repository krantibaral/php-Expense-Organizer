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
  //decoded the recived json into and store into $obj variable
  $obj = json_decode($json, true);
//   print_r($_POST) ;
//   $obj = $_POST;
  //getting name from $obj object
  $name = $obj['name'];
  $password = $obj['password'];
  $loginQuery = "select * from kranti where name = '$name' and password = '$password' ";
  $check = mysqli_fetch_array(mysqli_query($con, $loginQuery));
  if (isset($check)){
      $onLoginSuccess = 'Login Matched';
      $SuccessMSG = json_encode($onLoginSuccess);
      echo $SuccessMSG;
  }

  else{
      $InvalidMSG = 'Invalid Username or Password';
      $InvalidMSGJSon = json_encode($InvalidMSG);

      echo $InvalidMSGJSon;
  }
  mysqli_close($con);
  ?>