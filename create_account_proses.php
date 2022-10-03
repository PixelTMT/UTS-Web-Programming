<?php
var_dump($_POST["username"]);
var_dump($_POST["email"]);
var_dump($_POST["password"]);
var_dump($_FILES["img"]["name"]);
if (
    !empty($_POST["username"]) && !empty($_POST["email"]) &&
    !empty($_POST["password"]) && !empty($_FILES["img"])
) {
    $id = 0;
    $username = $_POST["username"];
    $email = $_POST["email"];
    $user_key = $_POST["password"];
    $img = $_FILES["img"]["name"];
    $img_temp = $_FILES["img"]['tmp_name'];

    //encryption here

    //check if database is empty

    if (check_img_type($img)) {
        move_uploaded_file($img_temp, "user_img/{$img}");
        insert_to_database($id, $username, $email, $user_key, $img);
    }
} else
    echo "proses failed";


function insert_to_database($_id, $_username, $_email, $_user_key, $_img)
{
    $dsn = "mysql:host=localhost;dbname=uts_forum";
    $kunci = new PDO($dsn, "root", "");

    $sql = "INSERT INTO user(id, username, email, user_key, img)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $kunci->prepare($sql);
    $data = [$_id, $_username, $_email, $_user_key, $_img];
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
