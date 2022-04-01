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

$token = $_POST["token"];
$password = $_POST["password"];


$response = array();
$sql = "SELECT email FROM password_resets WHERE token=$token LIMIT 1";
$db = mysqli_connect('localhost', 'root', '', 'learning');
$results = mysqli_query($db, $sql);
$email = mysqli_fetch_assoc($results)['email'];


if ($email) {
    // $new_pass = md5($new_pass);
    $sql2 = "UPDATE kranti SET password='$password' WHERE email='$email'";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $response[0] = array(
        'status' => "Password Changed"
    );
    $sql3 = "DELETE FROM password_resets WHERE token=$token";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
} else {
    $response[0] = array(
        'status' => "Problem while changing password"
    );
}

echo json_encode($response[0], JSON_PRETTY_PRINT);