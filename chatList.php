<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$room_idx = $_POST['room_idx']; // 현재 채팅방을 불러올 유저의 고유 아이디값

$sql = mq("select * from chat where room_idx = '".$room_idx."'"); 

$response = array();

while($row = mysqli_fetch_assoc($sql)){

    $query = mq("select * from user where user_idx = '".$row['chat_user']."'"); 
    $user =  $query->fetch_array();

    array_push($response,
    array(
        'chat_content' => $row['chat_content'],
        'room_idx' => $row['room_idx'],
        'chat_user' => $row['chat_user'],
        'chat_dateTime' => $row['chat_date'],
        'chat_profile_photo' => "http://3.36.52.195/profile/".$user['user_profile'],
        'chat_nickname' => $user['user_nickname'],
        'chat_type' => $row['chat_type']
    ));

}

echo json_encode($response);
?>