<?php
session_start();
require_once 'db.php';
if(isset($_SESSION['OTPTimespan'])){
    if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = '';
        header('location: verifyEmail.php');
        return;
    }
}
if(isset($_POST['OTPverify'])){
    if($_POST['OTPverify'] != '' && 
    $_POST['OTPverify'] == $_SESSION['OTPcode']){
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = 'YOU WIN!';
        if(isset($_SESSION['email'])){
            if($_SESSION['email'] != ''){
                $sql = "UPDATE user 
                    SET email = ?
                    WHERE id = ?";
                $stmt = $db->prepare($sql);
                $data = [$_SESSION["email"], $_SESSION["id"]];
                $stmt->execute($data);
                $_SESSION["email"] = $_SESSION["email"];
                header('location: edit_profile.php');
                return;
            }
        }
        header('location: newPassword.php');
    }
    else{
        $_SESSION['ERROR'] = 'Wrong OTP';
        header('location: verifyEmail.php');
    }
}
else header('location: login_form.php');