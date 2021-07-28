<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
    $sql = mq("select * from user where user_idx='".$_POST['user_idx']."'");
    $user = $sql->fetch_array();

    $user_idx = $_POST['user_idx'];
    $user_nickname = $_POST['user_nickname'];
    $user_introduction = $_POST['user_introduction'];

        if($user['user_nickname'] == $user_nickname && $user['user_introduction'] == $user_introduction ){
            
            $response['status'] = 0;
            $response['message'] = "이전 내용과 같습니다.";
        }else{
            $sql_nickname = mq("update user set user_nickname = '".$user_nickname."' where user_idx = '".$user_idx."'");
            $sql_introduction = mq("update user set user_introduction = '".$user_introduction."' where user_idx = '".$user_idx."'");
            $response['status'] = 1;
            $response['message'] = "정상적으로 변경되었습니다.";
        }
    

         echo json_encode($response);
    // date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    // echo date("Y-m-d H:i:s");
    // phpinfo();
?>