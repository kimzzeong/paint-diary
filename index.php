<?php
$db = mysqli_connect("localhost", "jeongin", "cru0817!!", "mysql");
if($db){
	    echo "connect<br>";
	    }
else{
	    echo "disconnect<br>";
}
phpinfo();
?>
