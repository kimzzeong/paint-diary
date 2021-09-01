<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['recomment_idx'])){
    $sql = mq("update diary_recomments set recomment_status='1' where recomment_idx='".$_GET['recomment_idx']."'");
    $response['message'] = "댓글이 정상적으로 삭제되었습니다.";

    echo json_encode($response);
}
?>