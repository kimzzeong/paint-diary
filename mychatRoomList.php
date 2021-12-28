<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$user_idx = $_POST['user_idx']; // 현재 채팅방을 불러올 유저의 고유 아이디값

$sql = mq("select * from chatRoom"); 

$response = array();
$room_name = "";



while($row = mysqli_fetch_assoc($sql)){

    $user = explode(',',$row['room_user']);

    if(in_array($user_idx,$user)){


        array_push($response,$row['room_idx']);
    }

}

echo json_encode($response);
?>