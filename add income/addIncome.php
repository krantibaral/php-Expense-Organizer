<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Accept: application/json");

$method =$_SERVER['REQUEST_METHOD'];

$response = array(
    'status' => $method,

);

echo json_encode($response);
?>