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
$response = array();
$sql = "SELECT * FROM kranti WHERE email='$email'";
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    $response[0] = array(
        'status' => "Account with the email doesn't exist."
    );
} else {
    $token = rand(100000, 999999);
    $sql2 = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $response[0] = array(
        "status" => $token,
    );


    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer;

    $mail->isSMTP();                      // Set mailer to use SMTP 
    $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
    $mail->SMTPAuth = true;               // Enable SMTP authentication 
    $mail->Username = 'imshraddha24@gmail.com';   // SMTP username 
    $mail->Password = 'nbowrsauehvoamrp';   // SMTP password 
    $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
    $mail->Port = 587;                    // TCP port to connect to 

    // Sender info 
    $mail->setFrom('imshraddha24@gmail.com', 'Shraddha Shrestha');
    $mail->addReplyTo($email, 'App User');

    // Add a recipient 
    $mail->addAddress($email);

    //$mail->addCC('cc@example.com'); 
    //$mail->addBCC('bcc@example.com'); 

    // Set email format to HTML 
    $mail->isHTML(true);

    // Mail subject 
    $mail->Subject = 'Password reset Verification Code';

    // Mail body content 
    $bodyContent = '<h1>Reset Password</h1>';
    // $bodyContent .= "Hi there, click on this <a href=\"new_password.php?token=" . $token . "\">link</a> to reset your password on our site";
    $bodyContent .= "Hi there, This is the verification code for resetting the password";
    $bodyContent .= "<h1>" . $token . "</h1>";
    $bodyContent .= "Enter this code in the application for further process";

    $mail->Body    = $bodyContent;
    if (!$mail->send()) {
        $response[0] = array(
            "status" => "There was a problem while sending mail",
        );
    } else {
    }
}
echo json_encode($response[0], JSON_PRETTY_PRINT);