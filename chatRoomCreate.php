<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_POST['user_idx'])){
    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");

    $sql = mq("INSERT INTO chatRoom
            (room_user,room_name,room_datetime)
            VALUES('{$_POST['user_idx']}','{$_POST['room_name']}','{$date}')");


    $response['message'] = $_POST['user_idx'] ;
    echo json_encode($response);
}
?>