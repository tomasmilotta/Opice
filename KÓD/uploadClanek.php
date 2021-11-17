<?php
  require "connectDB.php";
  session_start();
  $login = $_SESSION['login'];
  $nazev = $_POST['name'];
  $dotaz = 'SELECT MAX(clanek_verze) from clanky where clanek_nazev ="'.$nazev.'";';
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  $verze = $radek["MAX(clanek_verze)"];
  if($verze==NULL){
    $verze=1;
  }else{
    $verze++;
  }
  //echo $verze;
  $name =  $_FILES['file']['name'];
  $targetDir = "clanky/".$login."/".$nazev."/v".$verze."/";//TODO: lokace v adresari podle autora a verze (pomocí db)
  if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
  }
  echo $targetDir;
  $targetFile = $targetDir.basename($_FILES['file']['name']);
  $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
  if(isset($_POST['submit'])){
    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetDir.$name)){
      session_start();
      $_SESSION['chyba'] = 0;
      header("location:spravaClanku.php");
    }else{
      session_start();
      $_SESSION['chyba'] = 1;
      header("location:pridatClanek.php");
    }
  }
  
 ?>
