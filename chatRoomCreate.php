<?php
//채팅방 생성 
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_POST['user_idx'])){
    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");

    $user_idx = explode(',',$_POST['user_idx']);
    $sql_select = mq("SELECT * from chatRoom");

    while($row = mysqli_fetch_assoc($sql_select)){
        $user = explode( ',', $row['room_user']);
        $users = "";
    

        for($i = 0; $i < count($user); $i++){
            if(in_array($user_idx[$i], $user)){
                $count++; 
            }

        }

        if($count == 2){
            break;
        }

        $count = 0;
    }


    
    if($count != 2){
        
        $sql = mq("INSERT INTO chatRoom
        (room_user,room_datetime)
        VALUES('{$_POST['user_idx']}','{$date}')");
        $response['message'] = "생성" ;
        $user = $_POST['user_idx'];

    }else{
        $user = $row['room_user'];
        $response['message'] = "안생성" ;
    }

    $sql_idx=mq("SELECT * FROM chatRoom where room_user='".$user."'"); 
    $room_idx=mysqli_fetch_assoc($sql_idx); 

    $response['room_idx'] = $room_idx['room_idx'];

    echo json_encode($response);
}
?>