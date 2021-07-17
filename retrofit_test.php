<?php
  include "db.php";
  if(isset($_POST['userid']) && isset($_POST['userpw'])){

    $query = mq("
  SELECT * FROM test
  ");
  
  $sql = mq("INSERT INTO test
  (data,pass)
  VALUES('{$_POST['userid']}','{$_POST['userpw']}')");
  echo $query;

  }
?>