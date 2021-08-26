<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['comment_idx'])){
    $comment_idx = $_GET['comment_idx'];
    $sql = mq("update diary_comments set comment_content='".$_GET['comment_content']."'where comment_idx='".$comment_idx."'");

    $response['message'] = "댓글이 수정되었습니다.";
    echo json_encode($response);
}
?>