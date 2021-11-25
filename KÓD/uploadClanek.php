<?php
  require "connectDB.php";
  session_start();
  $login = $_SESSION['login'];
  $id = $_SESSION['user_id'];
  $nazev = $_POST['name'];
  $dotaz = 'SELECT MAX(clanek_verze) from clanky join users on clanky.clanek_autor=users.user_id where clanek_nazev ="'.$nazev.'" and user_id='.$id.';';
  echo $dotaz;
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  $verze = $radek["MAX(clanek_verze)"];
  if($verze==NULL){
    $verze=1;
  }else{
    $verze++;
  }
  echo $verze;
  echo $nazev;
  $name =  $_FILES['file']['name'];
  $targetDir = "clanky/".$login."/".str_replace(" ","",$nazev)."/v".$verze."/";
  echo $targetDir;
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
      $dotaz = 'SELECT clanek_id from clanky join users on clanky.clanek_autor=users.user_id where clanek_nazev = "'.$nazev.'" and user_id='.$id.';';
      $vysledek = mysqli_query($spojeni, $dotaz);
      $radek = mysqli_fetch_assoc($vysledek);
      $dotaz = 'UPDATE clanky set clanek_obsah="'.$name.'",clanek_stav=1, clanek_verze='.$verze.', clanek_zpravaRedaktora=DEFAULT, clanek_zpravaRecenzenta=DEFAULT, clanek_zpravaSefredaktora = NULL where clanek_id='.$radek["clanek_id"].';';
      mysqli_query($spojeni, $dotaz);
      header("location:spravaClanku.php");
    }else{
      session_start();
      $_SESSION['chyba'] = 1;
      header("location:pridatClanek.php");
    }
  }

 ?>
