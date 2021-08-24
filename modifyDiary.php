<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_POST['diary_idx'])){
    $diary_idx = $_POST['diary_idx'];
    $sql = mq("update diary set 
    diary_title='".$_POST['diary_title']."',
    diary_weather='".$_POST['diary_weather']."',
    diary_range='".$_POST['diary_range']."',
    diary_content='".$_POST['diary_content']."',
    diary_date='".$_POST['diary_date']."',
    diary_secret='".$_POST['diary_secret']."'
        where diary_idx='".$diary_idx."'");

    $response['diary_idx'] = $diary_idx ;
    echo json_encode($response);
}
?>