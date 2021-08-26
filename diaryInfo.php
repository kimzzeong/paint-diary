<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

if(isset($_POST['diary_idx']) && isset($_POST['diary_writer'])){

  $diary_idx = $_POST['diary_idx'];
  $sql = mq("SELECT * FROM diary where diary_idx = '".$diary_idx."' and diary_status = 0");
  $sql_diary = mq("select * from diary where diary_idx = '".$diary_idx."' and diary_status = 1");
  $diary =  $sql->fetch_array();
  $sql_user = mq("SELECT * FROM user where user_idx = '".$_POST['diary_writer']."'");
  $user =  $sql_user->fetch_array();
  //글쓴이 프로필 부분
  $response['user_intro'] = $user['user_introduction'];
  $response['diary_nickname'] = $user['user_nickname'];
  $response['user_profile'] = $user['user_profile'];
  
  //일기 정보 부분
  $response['diary_painting'] = $diary['diary_painting'];
  $response['diary_date'] = $diary['diary_date'];
  $response['diary_title'] = $diary['diary_title'];
  $response['diary_weather'] = $diary['diary_weather'];
  $response['diary_range'] = $diary['diary_range'];
  $response['diary_content'] = $diary['diary_content'];
  $response['diary_secret'] = $diary['diary_secret'];
  $response['diary_status'] = mysqli_num_rows($sql_diary);
}


echo json_encode($response);
?>