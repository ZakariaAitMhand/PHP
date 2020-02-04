<?php
session_start();
session_destroy();
setcookie('cin');
setcookie('pass');
setcookie('Admin_pass');
header("location:index.php");
?>