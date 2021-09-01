<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['recomment_idx'])){
    $recomment_idx = $_GET['recomment_idx'];
    $sql = mq("update diary_recomments set recomment_content='".$_GET['recomment_content']."' where recomment_idx='".$recomment_idx."'");

    $response['message'] = "댓글이 수정되었습니다.";
    echo json_encode($response);
}
?>