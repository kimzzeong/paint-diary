<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$con=mysqli_connect("localhost","jeongin","cru0817!!","paint_diary");

    date_default_timezone_set('Asia/Seoul'); //시간 서울로 세팅
    $date = date("Y-m-d H:i:s");
    
    if($_FILES['chat_image']['size'] > 0){

        $img_name = $_FILES['chat_image']['name'];
        $img_size = $_FILES['chat_image']['size'];
        $tmp_name = $_FILES['chat_image']['tmp_name'];
        $error = $_FILES['chat_image']['error'];
        $img_upload_path = 'chat_photo/'.$img_name;


        $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg","jpeg","png");
        if (in_array($img_ex_lc,$allowed_exs)) {
        

            move_uploaded_file($tmp_name, $img_upload_path);

        }
        echo $img_name;
    }
?>