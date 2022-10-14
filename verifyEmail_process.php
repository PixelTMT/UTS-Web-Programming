<?php
session_start();
require_once 'db.php';
if(isset($_SESSION['OTPTimespan'])){
    if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
        $_SESSION['ERROR'] = 'OTP Expire';
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = '';
        exit(header('location: verifyEmail.php'));
        return;
    }
}
if(isset($_POST['OTPverify'])){
    if($_POST['OTPverify'] != '' && 
    $_POST['OTPverify'] == $_SESSION['OTPcode']){
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = 'YOU WIN!';
        if(isset($_SESSION["WChangeEmail"])){
            if($_SESSION["WChangeEmail"] == 1){
                $sql = "UPDATE user 
                    SET email = ?
                    WHERE id = ?";
                $stmt = $db->prepare($sql);
                $data = [$_SESSION["ChangeEmail"], $_SESSION["id"]];
                $stmt->execute($data);
                $_SESSION["email"] = $_SESSION["ChangeEmail"];
                $_SESSION["WChangeEmail"] = 0;
                unset($_SESSION["ChangeEmail"]);
                exit(header('location: edit_profile.php'));
                return;
            }
        }
        exit(header('location: newPassword.php'));
        return;
    }
    else{
        $_SESSION['ERROR'] = 'Wrong OTP CODE';
        exit(header('location: verifyEmail.php'));
        return;
    }
    $_SESSION['ERROR'] = "Wrong OTP CODE";
    exit(header('location: create_account_verify.php'));
    return;
}
exit(header('location: login_form.php'));