<!DOCTYPE HTML>
<html lang="cs">
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    ?>
    <title><?php echo (isset($title))?$title:"Zelené Levo"?></title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
  </head>
  <body>
    <ul style="list-style:none"> <!-- dodělat menu-->
      <?php
        if(isset($_SESSION["login"])){
          // TODO:
          $role = $_SESSION["role"];
          echo '<li>'.$_SESSION["name"].' '.$_SESSION["sname"].' | Login: '.$_SESSION["login"].' | Role: '.$_SESSION["roleName"].'</li>';
          echo '<li><a href="logout.php">Odhlásit se</li></a>';
          if($_SESSION["role"]==3){
            echo('<li><a href="spravaClanku.php">Správa mých článků</a></li>');
          }else if($role==2 || $role == 6 || $role==7){
            echo('<li><a href="spravaClanku.php">Správa článků</a></li>');
          }
        }else{
          echo '<form action="login.php" method="get">';
          echo '<li>Login: <input type="text" name="login"></li>';
          echo '<li>Heslo: <input type="password" name="pass"></li>';
          echo '<li><input type="submit" value="Přihlásit"></li>';
          echo '</form>';
          echo '<li><a href="registrace.php">Registrace</a></li>';
        }
       ?>
       <li><a href="clanky.php">Vydané články</a></li>
    </ul>
