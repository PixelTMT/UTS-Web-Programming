<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if (empty($_SESSION['id'])) {
    exit(header('location: login_form.php'));
}