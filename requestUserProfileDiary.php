<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary where diary_status = 0 and diary_writer = '".$_POST['diary_wirter']."' order by diary_idx desc");
$response = array();
$date = 0;



while($row = mysqli_fetch_assoc($sql)){
    $sql_user = mq("select * from user where user_idx='".$row['diary_writer']."'"); /* 받아온 idx값을 선택 */
    $user = $sql_user->fetch_array();
    $date_sub = substr($row['diary_date'], 0, 7);
    if($date != $date_sub){
        $type = 0;
        array_push($response,
    array(
        'diary_date' => $row['diary_date'],
        'type' => $type

    ));
    $type = 1;
    }else{
        $type = 1;
    }
    array_push($response,
    array(
        'diary_idx' => $row['diary_idx'],
        'diary_title' => $row['diary_title'],
        'diary_writer' => $row['diary_writer'],
        'diary_painting' => $row['diary_painting'],
        'diary_secret' => $row['diary_secret'],
        'user_nickname' => $user['user_nickname'],
        'diary_date' => $row['diary_date'],
        'type' => $type

    ));
    
    $date = $date_sub;
}

echo json_encode($response);
?>