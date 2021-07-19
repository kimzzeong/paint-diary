<?php
$password = password_hash("11", PASSWORD_BCRYPT );

echo gettype($password);

?>