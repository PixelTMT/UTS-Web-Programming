<?php
require_once 'db.php';
function deletePost($_id){
    global $db;
    $sql = "DELETE FROM comment 
            WHERE post_id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_id];
    $stmt->execute($data);
    $sql = "DELETE FROM post 
            WHERE id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_id];
    $stmt->execute($data);
}
function deleteComment($_id){
    global $db;
    $sql = "DELETE FROM comment 
            WHERE id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_id];
    $stmt->execute($data);
}
function banUser($_id){
    global $db;
    $sql = "INSERT INTO banned(user_id) VALUE(?)";
    $stmt = $db->prepare($sql);
    $data = [$_id];
    $stmt->execute($data);
}
function unbanUser($_id){
    global $db;
    $sql = "DELETE FROM banned WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_id];
    $stmt->execute($data);
}
function deleteUser($_id){
    global $db;

    $sql = "DELETE FROM user 
            WHERE id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_id];
    $stmt->execute($data);
}