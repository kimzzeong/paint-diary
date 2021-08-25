<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_POST['diary_idx']) && isset($_POST['comment_content']) && isset($_POST['comment_writer']) && isset($_POST['comment_secret'])){
    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");

    $sql = mq("INSERT INTO diary_comments
            (diary_idx,comment_writer,comment_datetime,comment_secret,comment_content,comment_status)
            VALUES('{$_POST['diary_idx']}','{$_POST['comment_writer']}','{$date}','{$_POST['comment_secret']}','{$_POST['comment_content']}','0')");

// $sql = mq("INSERT INTO diary_comments
//             (diary_idx,comment_writer,comment_datetime,comment_secret,comment_content,comment_status)
//             VALUES('{$_POST['diary_idx']}','{$_POST['comment_writer']}','{$date}','{$_POST['comment_secret']}',
//             '{$_POST['comment_content']}','0')");

    $response['message'] = "댓글이 정상적으로 등록되었습니다." ;
    echo json_encode($response);
}

?>