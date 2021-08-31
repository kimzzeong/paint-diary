<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_POST['recomment_content']) && isset($_POST['comment_idx']) && isset($_POST['recomment_writer']) && isset($_POST['recomment_secret'])){
    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");

    $sql = mq("INSERT INTO diary_recomments
            (recomment_content,comment_idx,recomment_writer,recomment_datetime,recomment_secret,recomment_status)
            VALUES('{$_POST['recomment_content']}','{$_POST['comment_idx']}','{$_POST['recomment_writer']}','{$date}','{$_POST['recomment_secret']}','0')");

// $sql = mq("INSERT INTO diary_comments
//             (diary_idx,comment_writer,comment_datetime,comment_secret,comment_content,comment_status)
//             VALUES('{$_POST['diary_idx']}','{$_POST['comment_writer']}','{$date}','{$_POST['comment_secret']}',
//             '{$_POST['comment_content']}','0')");

    $response['message'] = "댓글이 정상적으로 등록되었습니다." ;
    echo json_encode($response);
}
?>