<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    ?>
    <title><?php echo (isset($title))?$title:"Logos Polytechnikos"?></title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
  </head>
  <body>
    <ul>
      <?php
        if(isset($_SESSION['login'])){
          // TODO:
        }else{
          echo "<li></li>";
        }
       ?>
    </ul>
