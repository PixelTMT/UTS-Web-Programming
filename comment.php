<?php
// include "Needlogin.php";
function get_comment($_post_id)
{
    global $db;
    $sql = "SELECT *, user_id,
    (
        SELECT username from user
        where id = user_id
    ) AS 'username',
    (
        SELECT img from user
        where id = user_id
    ) AS 'img'
    from comment
    WHERE post_id = ?
    ORDER BY date_created DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute([$_post_id]);
    return $stmt;
}

function get_comment_total($_post_id)
{
    global $db;
    $sql = "SELECT COUNT(post_id) AS total_comment
    FROM comment
    GROUP BY post_id
    HAVING post_id = ?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$_post_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        return 0;
    } else return $row["total_comment"];
}
