<?php
require_once 'security.php';
session_start();
if(($_SESSION['OTPTimespan'] != 'YOU WIN!' && $_SESSION['OTPcode'] != 'YOU WIN!') ||
    ($_SESSION['OTPTimespan'] == 'PASSCHANGE' && $_SESSION['OTPcode'] == 'PASSCHANGE') ){
    exit(header('location: login_form.php'));
}
if(isset($_POST["password"]) && isset($_POST['password2'])){
    if (CheckValidString($_POST["password"]) || CheckValidString($_POST['password2'])) {
        $_SESSION['ERROR'] = "Password must be alphanumeric";
        exit(header('location: newPassword.php'));
    }
    if ($_POST["password"] != $_POST['password2']) {
        $_SESSION['ERROR'] = "Password not match";
        exit(header('location: newPassword.php'));
    }
    $encrypted = Encode($_POST["password"]);
    $user_key = $encrypted['key'];
    $encrypted_password = $encrypted['encoded'];
    $sql = "UPDATE user 
    SET user_key = ?, encrypted_password = ?
    WHERE email = ?";
    $stmt = $db->prepare($sql);
    $data = [$user_key, $encrypted_password, $_SESSION["ChangeEmail"]];
    $stmt->execute($data);
    session_destroy();
    exit(header('location: passwordChanges.php'));
    $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = 'PASSCHANGE';
}
exit(header('location: newPassword.php'));