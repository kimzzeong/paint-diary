<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
$sql_diary = mq("select * from diary where diary_idx = '37' and diary_status = 0");

echo mysqli_num_rows($sql_diary);
// while($row = mysqli_fetch_assoc($sql)){
//     echo $row['comment_idx']."<br>";
// }
?>