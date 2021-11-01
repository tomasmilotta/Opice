<!DOCTYPE HTML>
<html lang="cs">
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    ?>
    <title><?php echo (isset($title))?$title:"Logos Polytechnikos"?></title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
  </head>
  <body>
    <ul style="list-style:none"> <!-- dodělat menu-->
      <?php
        if(isset($_SESSION["login"])){
          // TODO:
          echo '<li>'.$_SESSION["name"].' '.$_SESSION["sname"].'  Login: '.$_SESSION["login"].'</li>';
          echo '<li><a href="logout.php">Odhlásit se</li></a>';
        }else{
          echo '<form action="login.php" method="get">';
          echo '<li>Login: <input type="text" name="login"></li>';
          echo '<li>Heslo: <input type="password" name="pass"></li>';
          echo '<li><input type="submit" value="Přihlásit"></li>';
          echo '</form>';
          echo '<li><a href="#">Registrace</a></li>'; //TODO: registrace uživatele (autora)
        }
       ?>
    </ul>
