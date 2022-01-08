<?php
  $subject = $_POST["predmet"];
  $msg = $_POST["zprava"];
  $sender = "From: <".$_POST["email"].">"."\r\n";
  if(mail("admin@broz.lol",$subject,$msg,$sender)){
    header("location:index.php");
  }
?>
