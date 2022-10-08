<?php
session_start();
include "security.php";
$sql = "SELECT * FROM user
WHERE id = ?";
//open database if needed
$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION["id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $email = "";
$img = $img_temp = "";
if (!empty($_POST["username"])) {
    $username = $_POST["username"];
    //$_SESSION["username"] = $username;
} else $username = $row["username"];

if (!empty($_POST["email"])) {
    $email = $_POST["email"];
} else $email = $row["email"];

if (!empty($_FILES["img"]["name"])) {
    $img = $_FILES["img"]["name"];
    //$_SESSION["img"] = GetImgType($img);
} else $img = $row["img"];

echo $username . " " . $email . " " . $img;
