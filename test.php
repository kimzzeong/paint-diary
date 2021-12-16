<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */

$chat = mq("select * from chat where room_idx = 52");
$chat_content =  $chat->fetch_array();

while($row = mysqli_fetch_assoc($chat)){

    $content = $row['chat_content'];
    echo "<br>";


}
echo $content;
?>