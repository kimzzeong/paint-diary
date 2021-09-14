<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
    if(isset( $_POST['user_idx'])){
        $user_idx = $_POST['user_idx'];
        $query = mq("SELECT * FROM user where user_idx = '".$user_idx."'");
        $user =  $query->fetch_array();
        $sql = mq("select * from diary where diary_status = 0 and diary_writer = '".$_POST['user_idx']."' order by diary_date desc, diary_idx desc");
    
        $response['user_nickname'] = $user['user_nickname'];
        $response['user_introduction'] = $user['user_introduction'];
        $response['user_profile'] = $user['user_profile'];
        $response['user_diary_count'] = mysqli_num_rows($sql);

        echo json_encode($response);

    }
?>