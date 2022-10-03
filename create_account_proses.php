<?php
require_once("security.php");
if (
    !empty($_POST["username"]) && !empty($_POST["email"]) &&
    !empty($_POST["password"]) && !empty($_FILES["img"])
) {
    $id = "U";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $img = $_FILES["img"]["name"];
    $img_temp = $_FILES["img"]['tmp_name'];
    $encrypted = Encode($_POST["password"]);
    $user_key = $encrypted['key'];
    $encrypted_password = $encrypted['encoded'];

    //check if database is empty

    if (check_img_type($img)) {
        // 0 = user, 1 = admin
        $id = GetID(0);
        move_uploaded_file($img_temp, "user_img/{$img}");
        insert_to_database($id, $username, $email, $user_key, $encrypted_password, $img);
    }
} else {
    echo "proses failed";
}


function insert_to_database($_id, $_username, $_email, $_user_key, $_encrypted_password, $_img)
{
    $dsn = "mysql:host=localhost;dbname=uts_forum";
    $kunci = new PDO($dsn, "root", "");

    $sql = "INSERT INTO user(id, username, email, user_key, encrypted_password, img)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $kunci->prepare($sql);
    $data = [$_id, $_username, $_email, $_user_key, $_encrypted_password, $_img];
    $stmt->execute($data);
}

function check_img_type($img_name)
{
    $img_type = explode(".", $img_name);
    $img_type = end($img_type);
    $img_type = strtolower($img_type);

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
            echo "ANDA HANYA BISA MELAKUKAN UPLOAD GAMBAR";
            return false;
    }
}

function GetID()
{
    $id = 0;
    $dsn = "mysql:host=localhost;dbname=uts_forum";
    $kunci = new PDO($dsn, "root", "");
    $sql = "SELECT * FROM user";
    $hasil = $kunci->query($sql);
    while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {
        $id = intval($row['id']);
    }
    $re = strval($type);
    $re .= str_pad(strval($id + 1), 4, '0', STR_PAD_LEFT);
    return $re;
}
