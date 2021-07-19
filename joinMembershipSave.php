<?php
  include "db.php";
  if(isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_nickname'])){    

    $query = mq("SELECT * FROM user");

    $password = password_hash($_POST['user_password'], PASSWORD_BCRYPT );
   //$password = password_hash($_POST['user_password'],PASSWORD_DEFAULT);

    $sql = mq("INSERT INTO user
    (user_email,user_password,user_nickname)
    VALUES('{$_POST['user_email']}','{$password}','{$_POST['user_nickname']}')");
  
  echo $query;
  }
?>