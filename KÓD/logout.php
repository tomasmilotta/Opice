<?php
session_start();
session_unset();
$_SESSION['msg-bad']="Byl jste odhlášen";
header("location:index.php");
exit;
?>
