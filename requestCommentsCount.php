<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$sql = mq("select * from diary_comments where diary_idx = '".$_POST['diary_idx']."' and comment_status = 0 ");
if(mysqli_num_rows($sql) == 0){
        $response['comment_count'] = 0;
    }else{
        $response['comment_count'] = mysqli_num_rows($sql);
    }
    echo json_encode($response);
?>