<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary_comments where diary_idx = '".$_POST['diary_idx']."' and comment_status = 0 order by comment_datetime");
$response = array();
while($row = mysqli_fetch_assoc($sql)){
    $sql_user = mq("select * from user where user_idx='".$row['comment_writer']."'"); /* 받아온 idx값을 선택 */
    $user = $sql_user->fetch_array();
    array_push($response,
    array(
        'comment_datetime' => $row['comment_datetime'],
        'comment_profile' => $user['user_profile'],
        'comment_writer' => $row['comment_writer'],
        'comment_content' => $row['comment_content'],
        'comment_nickname' => $user['user_nickname']

    ));
}

echo json_encode($response);

?>