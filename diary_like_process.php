<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_GET['user_idx']) && isset($_GET['diary_idx'])){
    $user_idx = $_GET['user_idx'];
    $diary_idx = $_GET['diary_idx'];
    $like_status = $_GET['like_status'];

    $sql = mq("select * from user_diary_like where user_idx = '".$user_idx."' and diary_idx = '".$diary_idx."'");
    $result = $sql -> fetch_array();
    if(isset($result)){
        if($like_status == 1){
            $like_status = 0;
        }else{
            $like_status = 1;
        }
        $update = mq("update user_diary_like set like_status = '".$like_status."' where user_idx = '".$user_idx."' and diary_idx = '".$diary_idx."'");

    }else{
        $insert = mq("INSERT INTO user_diary_like
        (diary_idx,user_idx,like_status)
        VALUES('{$diary_idx}','{$user_idx}','{$like_status}')");
    }

}

?>