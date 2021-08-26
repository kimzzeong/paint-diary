<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['comment_idx'])){
    $sql = mq("update diary_comments set comment_status='1' where comment_idx='".$_GET['comment_idx']."'");
    $response['message'] = "댓글이 정상적으로 삭제되었습니다.";

    echo json_encode($response);
}
?>