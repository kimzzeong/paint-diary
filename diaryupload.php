<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$con=mysqli_connect("localhost","jeongin","cru0817!!","paint_diary");

    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");
    
    if($_FILES['diaryBitmap']['size'] > 0){

        $img_name = $_FILES['diaryBitmap']['name'];
        $img_size = $_FILES['diaryBitmap']['size'];
        $tmp_name = $_FILES['diaryBitmap']['tmp_name'];
        $error = $_FILES['diaryBitmap']['error'];
        $img_upload_path = 'diary/'.$img_name;


        $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg","jpeg","png");
        if (in_array($img_ex_lc,$allowed_exs)) {
        

            move_uploaded_file($tmp_name, $img_upload_path);
            
            mysqli_query($con,"INSERT INTO diary
            (diary_writer,diary_title,diary_weather,diary_range,diary_content,diary_secret,diary_date,diary_status,diary_painting)
            VALUES('{$_POST['user_idx']}','{$_POST['diary_title']}','{$_POST['diary_weather']}','{$_POST['diary_range']}',
            '{$_POST['diary_content']}','{$_POST['diary_secret']}','{$_POST['diary_date']}','0','{$img_name}')");

        }
        //$response['message'] = "글이 정상적으로 등록되었습니다.";
        $diary_idx = mysqli_insert_id($con);
        $response['diary_idx'] = mysqli_insert_id($con) ;
        echo json_encode($response);
    }
?>