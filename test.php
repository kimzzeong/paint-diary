<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary where diary_status = 0 order by diary_idx desc");
$response = array();



while($row = mysqli_fetch_assoc($sql)){
    $sql_user = mq("select * from user where user_idx='".$row['diary_writer']."'"); /* 받아온 idx값을 선택 */
    $user = $sql_user->fetch_array();
    $date = $row['diary_date'];
    $type;
    array_push($response,
    array(
        'diary_idx' => $row['diary_idx'],
        'diary_title' => $row['diary_title'],
        'diary_writer' => $row['diary_writer'],
        'diary_painting' => $row['diary_painting'],
        'user_nickname' => $user['user_nickname'],
        'diary_date' => $row['diary_date'],
        'type' => $type

    ));
}

echo json_encode($response);
?>