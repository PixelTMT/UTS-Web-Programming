<?php
session_start();
include "db.php";
include "NeedLogin.php";
include "comment.php";
$post_id = $_POST["post_id"];
$user_id = $_SESSION["id"];
$body = $_POST["body"];
$id = getID("C");
$curr_date = date("Y-m-d");
$curr_time = date("H:i:s");

if ($body != "") {
    initialize_comment($user_id, $post_id, $body, $curr_time, $curr_date, $id);
    echo "<div class='text-left' style='color:green'> <b> Your comment has been made! </b> </div>";
} else {
    echo "<div class='text-left' style='color:red'> <b> Your comment cannot be empty! </b> </div>";
}

function initialize_comment($_user_id, $_post_id, $_body, $_time_created, $_date_created, $_id)
{
    global $db;
    $sql = "INSERT INTO comment(user_id, post_id, body, time_created, date_created, id) 
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $data = [$_user_id, $_post_id, $_body, $_time_created, $_date_created, $_id];
    $stmt = $stmt->execute($data);
}

function GetID($type)
{
    $id = 0;
    $sql = "SELECT * FROM comment";
    global $db;
    $hasil = $db->query($sql);
    while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {
        $id = intval(substr($row['id'], 1));
    }
    $re = strval($type);
    $re .= str_pad(strval($id + 1), 4, '0', STR_PAD_LEFT);
    return $re;
}

?>
<?php include_once "comment.php" ?>
<?php $stmt2 = get_comment($post_id);
$flag = 0; ?>

<div id="test-<?= $post_id ?>">
    <?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
        <?php $flag = 1; ?>
        <div class="card mb-3 comment-container show_comment_container-<?= $row2["post_id"] ?>">
            <div class="d-flex flex-column w-100">
                <div class="card-container d-flex align-items-center mb-2 text-nowrap">
                    <div class="user-container d-flex align-items-center mb-2 text-nowrap col-lg-12">
                        <div style="min-width: 50px; min-height: 40px; overflow:hidden;">
                            <a href="user_profile.php?id=<?= $row2['user_id'] ?>">
                                <img src=<?= "user_img/" . $row2['user_id'].".jpg?".time() ?> alt="user img" class="p-0 rounded-circle" style="width: 40px; height: 40px; object-fit:cover;">
                            </a>
                        </div>
                        <a style="text-decoration: none; color: black;" class="detail-user-profile" href="user_profile.php?id=<?= $row2['user_id'] ?>">
                            <span class="post-username me-1"><?= $row2['username'] ?></span>
                        </a>

                        <i class="fa-solid fa-circle mx-1" style="font-size: 5px;"></i>
                        <span class="post-date ms-1 text-muted" style="font-size: 15px;"><?= $row2['date_created'] ?></span>
                    </div>
                </div>
                <div class="content-container d-flex flex-column">
                    <p class="card-text"><?= $row2['body'] ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($flag == 0) { ?>
        <div class=" card comment-container show_comment_container-<?= $post_id ?>">
            <div class="d-flex flex-column w-100 text-center py-1">
                <h4 class="pt-2"> no comments yet.. </h4>
            </div>
        </div>
    <?php } ?>
</div>