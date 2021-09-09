<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary where diary_status = 0 order by diary_idx desc"); //diary_date desc, 

// $listing_num = $_POST['listing_num'];

// if($listing_num == 0){
//     $sql = mq("select * from diary where diary_status = 0 and diary_secret = 0 order by diary_idx desc"); //diary_date desc, 
// }else if($listing_num == 1){
//     $sql = mq("select * from diary where diary_status = 0 and diary_secret = 0 order by diary_date desc ,diary_idx desc"); //diary_date desc, 
// }else if($listing_num == 2){
//     $sql = mq("select * from diary where diary_status = 0 and diary_secret = 0 order by diary_idx desc"); //diary_date desc, 
// }else{
//     $sql = mq("select * from diary where diary_status = 0 and diary_secret = 0 order by diary_idx desc"); //diary_date desc, 
// }

$response = array();



while($row = mysqli_fetch_assoc($sql)){
    $sql_user = mq("select * from user where user_idx='".$row['diary_writer']."'"); /* 받아온 idx값을 선택 */
    $user = $sql_user->fetch_array();
    $sql_like = mq("select * from user_diary_like where diary_idx = '".$row['diary_idx']."' and like_status = 1");
    $sql_comment = mq("select * from diary_comments where diary_idx = '".$row['diary_idx']."' and comment_status = 0");
    $like = mysqli_num_rows($sql_like);
    $comment = mysqli_num_rows($sql_comment);
    array_push($response,
    array(
        'diary_idx' => $row['diary_idx'],
        'diary_title' => $row['diary_title'],
        'diary_writer' => $row['diary_writer'],
        'diary_painting' => $row['diary_painting'],
        'diary_secret' => $row['diary_secret'],
        'diary_date' => $row['diary_date'],
        'diary_like_count' => $like,
        'diary_comment_count' => $comment,
        'user_nickname' => $user['user_nickname']

    ));
}

echo json_encode($response);
?>