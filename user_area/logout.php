<?php
session_start();
session_unset();
session_destroy();
echo "<script>showSwal('auto-close');</script>";
echo "<script>window.open('./user_login.php','_self')</script>"
?>