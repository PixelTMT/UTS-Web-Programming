<?php
session_start();
require 'db.php';
require 'mailing.php';
global $db;

if(isset($_POST['back'])) {
    header('location: profile.php');
    return;
}

if (isset($_POST['username'])){
    if($_POST['username'] != $_SESSION['username']){
        $sql = "UPDATE user 
            SET username = ?
            WHERE id = ?";
        $stmt = $db->prepare($sql);
        $data = [$_POST["username"], $_SESSION["id"]];
        $stmt->execute($data);
        $_SESSION["username"] = $_POST["username"];
    }
}
if (!empty($_FILES['img']["name"])){
    $img = $_FILES["img"]["name"];
    $img_temp = $_FILES["img"]['tmp_name'];
    $file_ext = explode(".", $img);
    $file_ext = end($file_ext);
    $file_ext = strtolower($file_ext);
    //check if database is empty
    $sql = "SELECT img FROM user
    WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION["id"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (check_img_type($file_ext)) {
        if(file_exists("user_img/".$row['img'])) unlink("user_img/".$row['img']);
        move_uploaded_file($img_temp, "user_img/{$_SESSION["id"]}.{$file_ext}");
        $sql = "UPDATE user 
        SET img = ?
        WHERE id = ?";
        $stmt = $db->prepare($sql);
        $data = ["{$_SESSION["id"]}.{$file_ext}", $_SESSION["id"]];
        $_SESSION['img'] = ".". $file_ext;
        $stmt->execute($data);
    }
}
if (isset($_POST['email'])){
    if($_POST['email'] != $_SESSION['email']){
        $_SESSION['ChangeEmail'] = $_POST['email'];
        $_SESSION['ERROR'] = "You where trying to change your email, we sending you a code to {$_POST['email']} to confirm";
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
        header('location: verifyEmail.php');
        return;
    }
}

header('location: edit_profile.php');


function check_img_type($img_type)
{
    switch ($img_type) {
        case 'jpg':
        case 'png':
        case 'jpeg':
        case 'svg':
        case 'webp':
        case 'bmp':
        case 'gif':
            return true;
            break;
        default:
            $_SESSION['ERROR'] = "YOU CAN ONLY UPLOAD AN IMAGE FILE.";
            return false;
    }
}