<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$user_idx = 28;
$diary_idx = 35;


$sql = mq("select * from user_diary_like where user_idx = '".$user_idx."' and diary_idx = '".$diary_idx."'");
$result = $sql -> fetch_array();
if(isset($result)){
    if($like_status == 1){
        $like_status = 0;
    }else{
        $like_status = 1;
    }

    print_r($result);
}
?>