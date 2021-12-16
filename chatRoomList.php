<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$user_idx = $_POST['user_idx']; // 현재 채팅방을 불러올 유저의 고유 아이디값

$sql = mq("select * from chatRoom order by room_datetime desc"); 

$response = array();
$room_name = "";



while($row = mysqli_fetch_assoc($sql)){

    $user = explode(',',$row['room_user']);

    if(in_array($user_idx,$user)){

        $content = "";

        for($i = 0; $i < count($user); $i++){
            if($user_idx != $user[$i]){
                $sql_nickname=mq("SELECT * FROM user where user_idx='".$user[$i]."'"); // 의 닉네임 가져오기
                $room_name=mysqli_fetch_assoc($sql_nickname); //sql2의 결과값에서 닉네임만 변수에 넣기
                //$room_name = $user[$i];
            }
        }


        $chat = mq("select * from chat where room_idx = '".$row['room_idx']."'");
        while($row2 = mysqli_fetch_assoc($chat)){
            if($row2['chat_type'] == 0){

                $content = $row2['chat_content'];
            }else{
                $content = "(사진)";
            }
        }
        

        array_push($response,
        array(
            'room_idx' => $row['room_idx'],
            'room_user' => $row['room_user'],
            'room_name' => $room_name['user_nickname'],
            'room_photo' => $room_name['user_profile'],
            'message' => $content,
            'room_datetime' => $row['room_datetime']
    
        ));
    }

}

echo json_encode($response);
?>