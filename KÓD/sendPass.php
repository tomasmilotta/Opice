<meta charset="utf-8">
<?php
  require "connectDB.php";
  $input = $_POST["input"];
  $dotaz = 'select count(user_id), user_email from users where(user_login = "'.$input.'" or user_email="'.$input.'") group by user_email;';
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  if($radek["count(user_id)"]!=0){
    $email = $radek["user_email"];
    $dotaz = 'select user_id, user_passwd from users where user_email="'.$email.'";';
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $heslo = $radek["user_passwd"];
    $id = $radek["user_id"];
    $subject = "Obnovení hesla";
    $msg = "Odkaz na obnovení hesla: <a href='http://broz.lol/recoverPass.php?id=".$id."&pass=".$heslo."'>ZDE!</a>";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: <admin@broz.lol>"."\r\n";
    if(mail($email,$subject,$msg,$headers))echo '<script>alert("Byl Vám odeslán e-mail pro obnovu hesla");window.location.href="forgotPasswd.php";</script>';
  }else{

    echo '<script>alert("Neplatný login nebo e-mail");window.location.href="forgotPasswd.php";</script>';
  }
?>
