<?php
session_start();
require_once("security.php");
if(!isset($_POST['username']) || !isset($_POST['password'])){
    $_SESSION['ERROR'] = "Please fill all required fields and submit again.";
    exit(header('location: login_form.php'));
}
if(!CheckValidString($_POST['username']) && !CheckValidString($_POST['password'])) {
    CheckAccount($_POST['username'], $_POST['password']);
}
else{
    $_SESSION['ERROR'] = "Input must be alphanumeric.";
    exit(header('location: login_form.php'));
}
