<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['comment_idx'])){
    $sql = mq("update diary_comments set comment_secret='".$_GET['comment_secret']."' where comment_idx='".$_GET['comment_idx']."'");

    if($_GET['comment_secret'] == 0){
        $response['message'] = "공개 댓글로 전환되었습니다.";
    }else{
        $response['message'] = "비밀 댓글로 전환되었습니다.";
    }

    echo json_encode($response);
}
?>