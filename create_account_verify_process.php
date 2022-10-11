<?php
session_start();
require_once 'security.php';
require_once 'db.php';
if(time() - $_SESSION['OTPTimespan'] > 60 * 5){
    $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = '';
    header('location: create_account_form.php');
    return;
}
if(isset($_POST['OTPverify'])){
    if($_POST['OTPverify'] != '' && 
    $_POST['OTPverify'] == $_SESSION['OTPcode']){
        
        $_SESSION['OTPTimespan'] = $_SESSION['OTPcode'] = 'YOU WIN!';
        $id = GetID(0);
        move_uploaded_file($_SESSION['img_temp'], "user_img/{$id}{$_SESSION['img']}");
        insert_to_database($id, $_SESSION['name'], $_SESSION['username'], $_SESSION['email'], $_SESSION['user_key'], $_SESSION['encrypted_password'], "{$id}{$_SESSION['img']}");
        session_destroy();
        header('location: login_form.php');
    }
}

function insert_to_database($_id, $_name, $_username, $_email, $_user_key, $_encrypted_password, $_img)
{
    global $blacklist;
    $sql = "INSERT INTO user(id, name, username, email, user_key, encrypted_password, img)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    global $db;
    $stmt = $db->prepare($sql);
    $_username = str_replace($blacklist, "", $_username);
    $_email = str_replace($blacklist, "", $_email);
    $data = [$_id, $_name, $_username, $_email, $_user_key, $_encrypted_password, $_img];
    $stmt->execute($data);
}

function GetID($type)
{
    $id = 0;
    $sql = "SELECT * FROM user";
    global $db;
    $hasil = $db->query($sql);
    while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {
        $id = intval($row['id']);
    }
    $re = strval($type);
    $re .= str_pad(strval($id + 1), 4, '0', STR_PAD_LEFT);
    return $re;
}