<?php
require_once 'security.php';
include_once("db.php");
session_start();


// if forgot button clicked
if (isset($_POST['email'])) {
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST["email"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // if exist
    if ($row) {
        if (CheckValidString($_POST["email"])) {
            $_SESSION['ERROR'] = "Invalid Email";
            header('location: forgot.php');
        }
        if(isset($_SESSION['OTPcode']) && $_SESSION['OTPTimespan']){
            if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
                $code = rand(999999, 111111);
                $_SESSION['OTPcode'] = $code;
                $_SESSION['OTPTimespan'] = time();
                $subject = 'Email Verification Code';
                $message = "Forgot your password? your verification code is $code, this code will expire in 5 minute";
                sendingEmail($_POST['email'], $subject, $message);
            }
        }
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['message'] = "We've sent a verification code to your Email <br> {$_POST['email']}";
        header('location: verifyEmail.php');
    } else {
        $_SESSION['ERROR'] = "Email doesn't Exist";
    }
}
else{
    header('location: forgot.php');
}