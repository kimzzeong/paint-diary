<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['diary_idx'])){
    $sql = mq("update diary set diary_status='1' where diary_idx='".$_GET['diary_idx']."'");
    $response['message'] = "글이 정상적으로 삭제되었습니다.";

    echo json_encode($response);
}
?>