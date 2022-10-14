<?php
if (!isset($_SESSION["id"])) {
    //blm login
    return  $_SESSION["isAdmin"] = "";
    echo "test1";
} else if (substr($_SESSION['id'], 0, 1) != '1') {
    echo "test2";
    //sudah login tapi bukan admin
    return  $_SESSION["isAdmin"] = "";;
} else {
    //sudah login tapi admin
    echo "test3";
    return $_SESSION['isAdmin'] = true;
}
