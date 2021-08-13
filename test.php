<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$user_idx = $_GET['user_idx'];
$password = $_GET['password'];
$new_password = $_GET['change_password'];
$check_new_password = $_GET['change_password_check'];


$password_check = mq("select user_password from user where user_idx='{$user_idx}'");
$password_check = $password_check->fetch_array();
$hash_pw = $password_check['user_password'];

  if ($new_password ==  $check_new_password) {
    if(password_verify($password, $hash_pw)){
      $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
      $fet = mq("update user set user_password = '".$hashedPassword."' where user_idx = '".$user_idx."'");
        $response['status'] = 1;
        $response['message'] = "비밀번호가 정상적으로 변경되었습니다.";
    }else{
        $response['status'] = 0;
        $response['message'] = "비밀번호가 일치하지 않습니다.";
    }
  }else{
    $response['status'] = 0;
    $response['message'] = "비밀번호가 일치하지 않습니다.";
  }

  echo json_encode($response);
?>