<?php
session_start();
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
//session_destroy();
header("Location: index.php ");	
?>