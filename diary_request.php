<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary order by diary_idx desc");

$response = array();

while($row = mysqli_fetch_assoc($sql)){
    array_push($response,
    array(
        'diary_idx' => $row['diary_idx'],
        'diary_title' => $row['diary_title'],
        'diary_wirter' => $row['diary_wirter'],
        'diary_painting' => $row['diary_painting'],

    ));
}

echo json_encode($response);
?>