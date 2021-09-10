<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$user_password = "dxGp8Gdl";
$user_email = "kimmju12@naver.com";

$sql_hash_pw = mq("select * from user where user_email='".$user_email."'");
$user = $sql_hash_pw->fetch_array();
$hash_pw = $user['user_password'];

$sql_password=mq("SELECT * FROM user where user_email='$user_email' && user_password = '$hash_pw'");



if($result=mysqli_fetch_array($sql_password)){//쿼리문을 실행해서 결과가 있으면 로그인 성공
    $sql_useridx=mq("SELECT * FROM user where user_email='".$user_email."'");
    $user = $sql_useridx->fetch_array();
    if($user['user_status'] == 1){
      $response['user_idx'] = null;
      $response['user_nickname'] = null;
      $response['status'] = 'null';
    }else{
      if (password_verify($user_password, $hash_pw)) {
          $response['user_idx'] = $user['user_idx'];
          $response['user_nickname'] = $user['user_nickname'];
          $response['status'] = 'success';
      }else{
        $response['user_idx'] = null;
        $response['user_nickname'] = null;
        $response['status'] = 'fail';
      }
    }
  }
 // echo $
  print_r($response);
?>