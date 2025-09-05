<?php
$new_pass = 111111;
$hashed_password = password_hash($new_pass, PASSWORD_BCRYPT);
echo $hashed_password;
?>