<?php
  include "db.php";
    
      
      if(isset($_POST['user_email'])&&isset($_POST['user_password'])){//post방식으로 데이터가 보내졌는지?
        $user_email=$_POST['user_email'];//post방식으로 보낸 데이터를 email이라는 변수에 넣는다.
        $user_password=$_POST['user_password'];//post방식으로 보낸 데이터를 password이라는 변수에 넣는다.

        $sql_hash_pw = mq("select * from user where user_email='".$user_email."'");
	      $user = $sql_hash_pw->fetch_array();
	      $hash_pw = $user['user_password'];

        $sql_nickname=mq("SELECT user_nickname FROM user where user_email='".$user_email."'"); // 로그인 하는 이메일의 닉네임 가져오기
        $nickname=mysqli_fetch_assoc($sql_nickname); //sql2의 결과값에서 닉네임만 변수에 넣기

        //sql문을 sql변수에 저장해놓는다.
        $sql_password=mq("SELECT * FROM user where user_email='$user_email' && user_password='$hash_pw'");

        if($result=mysqli_fetch_array($sql_password)){//쿼리문을 실행해서 결과가 있으면 로그인 성공
          if (password_verify($user_password, $hash_pw)) {
            $sql_userIdx=mq("SELECT * FROM user where user_email='".$user_email."'");
            $user = $sql_userIdx->fetch_array();
              $response['user_idx'] = $user['user_idx'];
              $response['user_nickname'] = $user['user_nickname'];
          }
        }else{
          $response['user_idx'] = null;
          $response['user_nickname'] = null;
        }
      }
      echo json_encode($response);
?>