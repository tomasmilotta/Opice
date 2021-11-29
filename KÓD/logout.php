<?php
session_start();
session_unset();
$_SESSION['msg-good']="Byl jste odhlášen";
header("location:index.php");
exit;
?>
