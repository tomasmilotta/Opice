<?php
  require "connectDB.php";
  session_start();
  if(isset($_GET["login"]) && isset($_GET["pass"])){
    $pass = $_GET["pass"];
    $pass = $pass."84oasů.f+A;Sa>wˇe8'(f4y6";
    $heslo = hash("sha256",$pass);
    $dotaz = 'select count(*) from users where user_login="'.$_GET["login"].'" and user_passwd="'.$heslo.'";';
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $cislo = $radek["count(*)"];

    if($cislo==1){
      $dotaz = 'select * from users join roles on roles.role_id = users.user_role where user_login="'.$_GET["login"].'" and user_passwd="'.$heslo.'";';
      $vysledek = mysqli_query($spojeni, $dotaz);
      $loguser = mysqli_fetch_assoc($vysledek);
      $_SESSION["user_id"]=$loguser["user_id"];
      $_SESSION["login"]=$loguser["user_login"];
      $_SESSION["pass"]=$loguser["user_passwd"];
      $_SESSION["name"]=$loguser["user_name"];
      $_SESSION["sname"]=$loguser["user_sname"];
      $_SESSION["role"]=$loguser["user_role"];
      $_SESSION["roleName"]=$loguser["role_name"];
      $_SESSION["email"]=$loguser["user_email"];
      header("location:index.php");
      exit;
    }else{
      echo("Neplatné přihlašovací jméno nebo heslo!<br>");
      echo('<a href="index.php">Zkusit znovu</a>');
    }
  }
 ?>
