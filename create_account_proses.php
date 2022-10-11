<?php
session_start();
require_once("security.php");
require_once 'mailing.php';

if (
    !empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["email"]) &&
    !empty($_POST["password"]) && isset($_FILES['img'])
) {
    if (CheckValidString($_POST["email"])) {
        $_SESSION['ERROR'] = "Invalid Email";
        exit(header('location: create_account_form.php'));
        return;
    }
    if(CheckEmailExist($_POST["email"])){
        $_SESSION['ERROR'] = "Email already Exist. try another one or login";
        exit(header('location: create_account_form.php'));
        return;
    }
    if (CheckValidString($_POST["password"]) || CheckValidString($_POST['password2'])) {
        if (CheckValidString($_POST["password"]) != CheckValidString($_POST['password2'])) {
            $_SESSION['ERROR'] = "Password not match";
            exit(header('location: create_account_form.php'));
            return;
        }
        $_SESSION['ERROR'] = "Password must be alphanumeric";
        exit(header('location: create_account_form.php'));
        return;
    }
    if (CheckValidString($_POST["username"])) {
        $_SESSION['ERROR'] = "username must be alphanumeric";
        exit(header('location: create_account_form.php'));
        return;
    }
    if(CheckUserNameExist($_POST["username"])){
        $_SESSION['ERROR'] = "username already Exist. try another one or login";
        exit(header('location: create_account_form.php'));
        return;
    }
    if (CheckValidString($_POST["name"])) {
        $_SESSION['ERROR'] = "name must be alphanumeric";
        exit(header('location: create_account_form.php'));
        return;
    }
    $_SESSION['email'] = $_POST["email"];
    $status = '';
    $code = rand(999999, 111111);
    $_SESSION['OTPcode'] = $code;
    $_SESSION['OTPTimespan'] = time();
    $subject = 'Email Verification Code';
    $message = "Forgot your password? your verification code is $code, this code will expire in 5 minute";
    $status = sendingEmail($_POST['email'], $subject, $message);
    if($status){
        $id = "U";

        $img = $_FILES["img"]["name"];
        $img_temp = $_FILES["img"]['tmp_name'];
        $file_ext = explode(".", $img);
        $file_ext = end($file_ext);
        $file_ext = strtolower($file_ext);
        if (check_img_type($file_ext, 'create_account_form.php')){
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['name'] = $_POST["name"];
            $_SESSION['username'] = $_POST["username"];
            $encrypted = Encode($_POST["password"]);
            $_SESSION['user_key'] = $encrypted['key'];
            $_SESSION['encrypted_password'] = $encrypted['encoded'];
            $_SESSION['img'] = ".". $file_ext;
            $_SESSION['img_temp'] = $img_temp;
            $_SESSION['file_ext'] = $file_ext;
            exit(header('location: create_account_verify.php'));
        }
    }
    else{
        $_SESSION['ERROR'] = "Failed to sending email to {$_POST['email']}, try again later";
        exit(header('location: create_account_form.php'));
    }
} else {
    $_SESSION['ERROR'] = "All fields are required. Please fill all required fields and submit again.";
    exit(header('location: create_account_form.php'));
}