<?php
  include "db.php";
  if(isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_nickname'])){    

    $email = $_POST['user_email'];
    $query = mq("SELECT * FROM user where user_email = '".$email."'");
    $user =  $query->fetch_array();

    $password = password_hash($_POST['user_password'], PASSWORD_BCRYPT );

    if(isset($user['user_email']) && $user['status'] = 0){
      $response['status'] = "fail";
  
    }else{

      $response['status'] = "success";

      $sql = mq("INSERT INTO user
      (user_email,user_password,user_nickname)
      VALUES('{$_POST['user_email']}','{$password}','{$_POST['user_nickname']}')");
    }
  
  echo json_encode($response);
  }
?>