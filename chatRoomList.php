<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from chatRoom order by room_idx desc"); 

$response = array();



while($row = mysqli_fetch_assoc($sql)){

    array_push($response,
    array(
        'room_idx' => $row['room_idx'],
        'room_user' => $row['room_user'],
        'room_name' => $row['room_name'],
        'room_datetime' => $row['room_datetime']

    ));
}

echo json_encode($response);
?>