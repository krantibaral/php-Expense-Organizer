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

$amount = $obj["amount"];
$category = $obj["category"];
//$date = $obj["date"];
$description =$obj["description"];

$sql_query = "INSERT INTO addexpense(amount, category, date, description) VALUES ('$amount', '$category', Now(), '$description')";
if(mysqli_query($con,$sql_query)){
    
    // If the record inserted successfully then show the message.
   $MSG = 'Expense details added successfully' ;
    
   // Converting the message into JSON format.
   $json = json_encode($MSG);
    
   // Echo the message.
    echo $json ;

}
else{

echo 'Try Again';
echo mysqli_error(($con)) ;

}
mysqli_close($con);
?>


