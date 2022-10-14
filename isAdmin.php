<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if (!isset($_SESSION["id"])) {
    //blm login
    exit(header('location: login_form.php'));
    return $_SESSION["isAdmin"] = false;
} else if (substr($_SESSION['id'], 0, 1) != '1') {
    //sudah login tapi bukan admin
    exit(header('location: login_form.php'));
    return $_SESSION["isAdmin"] = false;
} else {
    //sudah login tapi admin
    return $_SESSION['isAdmin'] = true;
}