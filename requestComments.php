<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary_comments where diary_idx = '".$_POST['diary_idx']."' and comment_status = 0 order by comment_datetime");
$sql_diary_writer = mq("select * from diary where diary_idx = '".$_POST['diary_idx']."'");
$diary_writer=$sql_diary_writer->fetch_array(); //sql2의 결과값에서 닉네임만 변수에 넣기
$response = array();
while($row = mysqli_fetch_assoc($sql)){
    $sql_user = mq("select * from user where user_idx='".$row['comment_writer']."'"); /* 받아온 idx값을 선택 */
    $user = $sql_user->fetch_array();
    array_push($response,
    array(
        'comment_datetime' => $row['comment_datetime'],
        'comment_profile' => $user['user_profile'],
        'comment_writer' => $row['comment_writer'],
        'comment_idx' => $row['comment_idx'],
        'comment_secret' => $row['comment_secret'],
        'comment_content' => $row['comment_content'],
        'comment_nickname' => $user['user_nickname']

    ));
}

echo json_encode($response);

?>