<?php
session_start();
include "db.php";
include "NeedLogin.php";
$val = 0;
$user_id = $_POST["user_id"];
$post_id = $_POST["post_id"];
$post_type = $_POST["post_type"];

if ($post_type == 0) {
    $row = getdata($user_id, $post_id);
    if (!$row) {
        initialize_like($user_id, $post_id);
    }
    $val = 1;
}

if ($post_type == 1) {
    $row = getdata($user_id, $post_id);
    if (!$row) {
        initialize_like($user_id, $post_id);
        $row = getdata($user_id, $post_id);
    }
    $val = 0;
}

$sql = "UPDATE likes
SET like_bool = ?
WHERE user_id = ? AND post_id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$val, $user_id, $post_id]);

$val = getTotalLikes($post_id);
echo $val;

function initialize_like($_user_id, $_post_id)
{
    global $db;
    $sql = "INSERT INTO likes(user_id, post_id, like_bool)
    VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_user_id, $_post_id, 0]);
}

function getdata($_user_id, $_post_id)
{
    global $db;
    $sql = "SELECT like_bool FROM likes
    WHERE user_id = ? AND post_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_user_id, $_post_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getTotalLikes($_post_id)
{
    global $db;
    $sql = "SELECT SUM(like_bool) AS total_likes FROM likes GROUP BY post_id having post_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_post_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row["total_likes"];
}
