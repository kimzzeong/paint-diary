<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary_recomments where comment_idx = '25' and recomment_status = 0 order by recomment_datetime");
$response = array();
while($row = mysqli_fetch_assoc($sql)){
    $sql_user = mq("select * from user where user_idx='".$row['recomment_writer']."'"); /* 받아온 idx값을 선택 */
    $user = $sql_user->fetch_array();
    array_push($response,
    array(
        'comment_datetime' => $row['recomment_datetime'],
        'comment_profile' => $user['user_profile'],
        'comment_writer' => $row['recomment_writer'],
        'comment_idx' => $row['comment_idx'],
        'comment_secret' => $row['recomment_secret'],
        'comment_content' => $row['recomment_content'],
        'comment_nickname' => $user['user_nickname']

    ));
}

echo json_encode($response);

?>