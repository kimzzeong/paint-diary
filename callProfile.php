<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
    if(isset( $_POST['user_idx'])){
        $user_idx = $_POST['user_idx'];
        $query = mq("SELECT * FROM user where user_idx = '".$user_idx."'");
        $user =  $query->fetch_array();
    
        $response['user_nickname'] = $user['user_nickname'];
        $response['user_introduction'] = $user['user_introduction'];
        $response['user_profile'] = $user['user_profile'];

        echo json_encode($response);

    }
?>