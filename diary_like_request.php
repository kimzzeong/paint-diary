<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$diary_idx = $_GET['diary_idx'];
$user_idx = $_GET['user_idx'];

$sql = mq("select * from user_diary_like where diary_idx = '".$diary_idx."' and like_status = 1");
$result = $sql -> fetch_array();
$sql_comments_count = mq("select * from diary_comments where diary_idx = '".$diary_idx."' and comment_status = 0");
$response['comments_count'] = mysqli_num_rows($sql_comments_count);
if(isset($result)){
  $sql_like = mq("select * from user_diary_like where diary_idx = '".$diary_idx."' and user_idx = '".$user_idx."'");
  $fetch = $sql_like->fetch_array();
  $response['like_status'] = $fetch['like_status'];
  $response['like_count'] = mysqli_num_rows($sql);
}else{
  $response['like_count'] = 0;
}
echo json_encode($response);
?>