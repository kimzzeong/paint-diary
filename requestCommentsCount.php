<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$sql = mq("select * from diary_comments where diary_idx = '".$_POST['diary_idx']."' and comment_status = 0 ");
$sql_re = mq("select * from diary_recomments where diary_idx = '".$_POST['diary_idx']."' and recomment_status = 0 ");
if(mysqli_num_rows($sql) == 0){
        $response['comment_count'] = 0;
    }else{
        $response['comment_count'] = mysqli_num_rows($sql)+mysqli_num_rows($sql_re);
    }
    echo json_encode($response);
?>