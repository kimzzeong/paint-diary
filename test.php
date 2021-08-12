<?php
header("Content-type:application/json");
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$sql = mq("select * from diary order by diary_idx desc");

while($row = mysqli_fetch_assoc($sql)){
    $cnt++;
}

echo mysqli_insert_id();
?>