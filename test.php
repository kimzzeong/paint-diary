<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$sql = mq("select * from diary_comments where diary_idx = 34");

while($row = mysqli_fetch_assoc($sql)){
    echo $row['comment_idx']."<br>";
}
?>