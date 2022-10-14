<?php
if (!isset($_SESSION["id"])) {
    //blm login
    return $_SESSION["isAdmin"] = false;
} else if (substr($_SESSION['id'], 0, 1) != '1') {
    //sudah login tapi bukan admin
    return $_SESSION["isAdmin"] = false;
} else {
    //sudah login tapi admin
    return $_SESSION['isAdmin'] = true;
}
