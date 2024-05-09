<?php
session_start(); 

session_unset();

session_destroy();


header("Location: /iBalay/saso/authlog/loginsaso.php");
exit; 
?>
