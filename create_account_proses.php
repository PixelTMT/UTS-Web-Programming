<?php
session_start();
require_once("security.php");
require_once 'mailing.php';
var_dump($name);

if (
    !empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["email"]) &&
    !empty($_POST["password"]) && isset($_FILES['img'])
) {
    if (CheckValidString($_POST["email"])) {
        $_SESSION['ERROR'] = "Invalid Email";
        header('location: create_account_form.php');
    }
    if (CheckValidString($_POST["password"]) || CheckValidString($_POST['password2'])) {
        if (CheckValidString($_POST["password"]) != CheckValidString($_POST['password2'])) {
            $_SESSION['ERROR'] = "Password not match";
            header('location: create_account_form.php');
        }
        $_SESSION['ERROR'] = "Password must be alphanumeric";
        header('location: create_account_form.php');
    }
    if (CheckValidString($_POST["username"])) {
        $_SESSION['ERROR'] = "username must be alphanumeric";
        header('location: create_account_form.php');
    }
    if (CheckValidString($_POST["name"])) {
        $_SESSION['ERROR'] = "name must be alphanumeric";
        header('location: create_account_form.php');
    }
    $_SESSION['email'] = $_POST["email"];
    if(isset($_SESSION['OTPcode']) && $_SESSION['OTPTimespan']){
        if(time() - $_SESSION['OTPTimespan'] > 60){
            $code = rand(999999, 111111);
            $_SESSION['OTPcode'] = $code;
            $_SESSION['OTPTimespan'] = time();
            $subject = 'Email Verification Code';
            $message = "Forgot your password? your verification code is $code, this code will expire in 5 minute";
            sendingEmail($_POST['email'], $subject, $message);
        }
    }

    $_SESSION['email'] = $_POST['email'];

    $id = "U";
    $_SESSION['name'] = $_POST["name"];
    $_SESSION['username'] = $_POST["username"];
    $encrypted = Encode($_POST["password"]);
    $_SESSION['user_key'] = $encrypted['key'];
    $_SESSION['encrypted_password'] = $encrypted['encoded'];
    $img = $_FILES["img"]["name"];
    $_SESSION['img_temp'] = $_FILES["img"]['tmp_name'];
    $_SESSION['file_ext'] = explode(".", $img);
    $_SESSION['file_ext'] = end($_SESSION['file_ext']);
    $_SESSION['file_ext'] = strtolower($_SESSION['file_ext']);
    
    header('location: create_account_verify.php');
} else {
    $_SESSION['ERROR'] = "All fields are required. Please fill all required fields and submit again.";
    header('location: create_account_form.php');
}