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
$email = $_GET['email'];
$token = $_GET['token'];
$response = array();
$sql = "SELECT * FROM password_resets WHERE email='$email'";
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    $response[0] = array(
        'status' => "The code is invalid"
    );
} else {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['email'] == $email && $row['token'] == $token) {
        $response[0] = array(
            'status' => "Passed"
        );
    } else {
        $response[0] = array(
            'status' => "Failed"
        );
    }
}
echo json_encode($response[0], JSON_PRETTY_PRINT);