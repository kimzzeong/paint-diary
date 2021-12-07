<?php
//채팅방 생성 
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");

    $user_idx = array('28','38');
    $sql_select = mq("SELECT * from chatRoom");

    while($row = mysqli_fetch_assoc($sql_select)){
        $user = explode( ',', $row['room_user']);
        $count = 0;
    

        for($i = 0; $i < count($user); $i++){
            if(in_array($user_idx[$i], $user))
            {
                echo "돈다".$count."<br>";
                $count++;
            }
        }
        
                
        if($count == 2){
                    
            $sql_idx=mq("SELECT * FROM chatRoom where room_user='".$row['room_user']."'"); 
            $room_idx=mysqli_fetch_assoc($sql_idx); //sql2의 결과값에서 닉네임만 변수에 넣기

            $response['room_idx'] = $room_idx['room_idx'];
            $response['message'] = "if" ;
        }else{
            $response['message'] = "else" ;
        }
        $response['count'] = $count ;

    }


    print_r($response);
?>