<?php
    include "db.php";
    if(isset( $_POST['user_idx'])){
        $user_idx = $_POST['user_idx'];
        $query = mq("update user set user_status = '1' where user_idx = '".$user_idx."'");
    
        $response['message'] = 'success';

        echo json_encode($response);

    }
?>