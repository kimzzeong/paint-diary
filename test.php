<?php
    include "db.php";
    $sql = mq("select * from user where user_idx='".$_POST['user_idx']."'");
    $user = $sql->fetch_array();
    if ($_FILES['profilePhoto']['size'] == 0) {
    }else{
        $img_name = $_FILES['profilePhoto']['name'];
             $img_size = $_FILES['profilePhoto']['size'];
             $tmp_name = $_FILES['profilePhoto']['tmp_name'];
             $error = $_FILES['profilePhoto']['error'];
             $img_upload_path = 'profile/'.$img_name;
             
             move_uploaded_file($tmp_name, 'profile/'.$img_name);
             
             $response['user_idx'] = $_POST['user_idx'];
             $response['message'] = "message";
             $response['profilePhoto'] = $img_name ;
    }

         echo json_encode($response);
    // date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    // echo date("Y-m-d H:i:s");
    // phpinfo();
?>