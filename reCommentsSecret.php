<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['recomment_secret'])){
    $sql = mq("update diary_recomments set recomment_secret='".$_GET['recomment_secret']."' where recomment_idx='".$_GET['recomment_idx']."'");

    if($_GET['recomment_secret'] == 0){
        $response['message'] = "공개 댓글로 전환되었습니다.";
    }else{
        $response['message'] = "비밀 댓글로 전환되었습니다.";
    }

    echo json_encode($response);
}
?>