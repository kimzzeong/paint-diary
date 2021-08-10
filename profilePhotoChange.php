<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

    $user_idx = $_POST['user_idx'];
    $user_nickname = $_POST['user_nickname'];
    $user_introduction = $_POST['user_introduction'];
    
    $sql = mq("select * from user where user_idx='".$user_idx."'");
    $user = $sql->fetch_array();
    if ($_FILES['profilePhoto']['size'] > 0) { //이미지 넘어옴

        
        $img_name = $_FILES['profilePhoto']['name'];
        $img_size = $_FILES['profilePhoto']['size'];
        $tmp_name = $_FILES['profilePhoto']['tmp_name'];
        $error = $_FILES['profilePhoto']['error'];
        $img_upload_path = 'profile/'.$img_name;

        $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
         $img_ex_lc = strtolower($img_ex);
         $allowed_exs = array("jpg","jpeg","png");
         if (in_array($img_ex_lc,$allowed_exs)) {
        

            move_uploaded_file($tmp_name, 'profile/'.$img_name);
            
            $response['status'] = 1;
            $response['user_idx'] = $user_idx;
            $response['message'] = "정상적으로 변경되었습니다.";
            $response['profilePhoto'] = $img_name ;
            
            $sql_nickname = mq("update user set user_nickname = '".$user_nickname."' where user_idx = '".$user_idx."'");
            $sql_introduction = mq("update user set user_introduction = '".$user_introduction."' where user_idx = '".$user_idx."'");
            $sql_profile = mq("update user set user_profile = '".$img_name."' where user_idx = '".$user_idx."'");
        }
        
    }
    if($_POST['user_profile'] == "basic"){
        
        $response['status'] = 1;
        $response['user_idx'] = $user_idx;
        $response['message'] = "정상적으로 변경되었습니다.";
        $response['profilePhoto'] = $img_name ;

        $sql_nickname = mq("update user set user_nickname = '".$user_nickname."' where user_idx = '".$user_idx."'");
        $sql_introduction = mq("update user set user_introduction = '".$user_introduction."' where user_idx = '".$user_idx."'");
        $sql_profile = mq("update user set user_profile = null where user_idx = '".$user_idx."'");
    }

         echo json_encode($response);
    // phpinfo();
?>