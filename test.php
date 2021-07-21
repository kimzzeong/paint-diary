<?php
    include "db.php";
    $email = "111";
    $pass = "111";
    $query = mq("SELECT * FROM user where user_email = '".$email."'");
    $test =  $query->fetch_array();
    echo $test['user_nickname'];
?>