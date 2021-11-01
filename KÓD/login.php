<?php
  require "connectDB.php";
  session_start();
  if(isset($_GET["login"]) && isset($_GET["pass"])){
    $pass = $_GET["pass"];
    //TODO: zabezpečení hesla
    //$heslo = ;
    $dotaz = 'select count(*) from users where user_login="'.$_GET["login"].'" and user_passwd="'.$pass.'";';
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $cislo = $radek["count(*)"];

    if($cislo==1){
      $dotaz = 'select * from users where user_login="'.$_GET["login"].'" and user_passwd="'.$pass.'";';
      $vysledek = mysqli_query($spojeni, $dotaz);
      $loguser = mysqli_fetch_assoc($vysledek);
      $_SESSION["user_id"]=$loguser["user_id"];
      $_SESSION["login"]=$loguser["user_login"];
      $_SESSION["pass"]=$loguser["user_passwd"];
      $_SESSION["name"]=$loguser["user_name"];
      $_SESSION["sname"]=$loguser["user_sname"];
      $_SESSION["role"]=$loguser["user_role"];
      $_SESSION["email"]=$loguser["user_email"];
      //echo $_SESSION["login"];
      header("location:index.php");
      exit;
    }else{
      echo("Chyba při přihlášení");
    }
  }
 ?>
