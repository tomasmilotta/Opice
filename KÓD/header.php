<!DOCTYPE HTML>
<html lang="cs">
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    ?>
    <title><?php
      if(isset($title)){
        echo $title;
      }else{
        echo "Zelené Levo";
      }
    ?></title>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </head>
  <body id="body">
    <div class="wrapper">
  <nav class="navbar navbar-expand-lg navbar-light" id="navik">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="img/logo2.png" alt="" height="58"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="clanky.php">Vydané články</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="helpdesk.php">Helpdesk</a>
        </li>
        <?php
            if(isset($_SESSION["login"])){
              $role = $_SESSION["role"];
              if($_SESSION["role"]==3){
                echo('<li class="nav-item"><a class="nav-link"  href="spravaClanku.php">Správa mých článků</a></li>');
              }else if($role==2 || $role == 6 || $role==7 || $role==4){
                echo('<li class="nav-item"><a class="nav-link"  href="spravaClanku.php">Správa článků</a></li>');
              }
              if($role == 2){
                echo('<li class="nav-item"><a class="nav-link"  href="spravaUzivatelu.php">Správa uživatelů</a></li>');
              }
            }
        ?>
      </ul>
        <ul class="navbar-nav">
        <li class="nav-item dropstart">        
          <?php
          if(isset($_SESSION["login"])){
          if(file_exists("img/users/".$_SESSION["login"])){
            echo '<img class="nav-link dropdown-toggle" id="user" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" src="img/users/'.$_SESSION["login"].'/avatar.jpg" height="64" width="64" style="border-radius: 50%;border: 2px solid white;padding:0">';
          }else{
            echo '<img class="nav-link dropdown-toggle" id="user"  data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" src="img/user.png" height="58">';
          }}else{
            echo '<img class="nav-link dropdown-toggle" id="user"  data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" src="img/user.png" height="58">';
          }
        if(isset($_SESSION["login"])){
          $role = $_SESSION["role"];
          echo "<ul class='dropdown-menu' id='logged'>";
          echo '<li class="nav-item px-1 d-flex justify-content-center fw-bold">'.$_SESSION["name"].' '.$_SESSION["sname"].' </li><li class="nav-item px-1"> Login: '.$_SESSION["login"].' </li><li class="nav-item px-1"> Role: '.$_SESSION["roleName"].'</li>';
          echo '<li class="nav-item  d-flex justify-content-center py-2"><a id="unlog" class="nav-link black-text btn fw-bold btn-outline-light" href="profile.php" role="button">Můj profil</li></a>';
          echo '<li class="nav-item  d-flex justify-content-center py-2"><a id="unlog" class="nav-link black-text btn fw-bold btn-outline-light" href="logout.php" role="button">Odhlásit se</li></a>';

        }else{
          echo "<ul class='dropdown-menu' id='unlogged'>";
          echo '<form  class="px-2 py-2" action="login.php" method="get">';
          echo '<li class="nav-item">Login: <input class="form-control" type="text" name="login"></li>';
          echo '<li class="nav-item">Heslo: <input class="form-control" type="password" name="pass"></li>';
          echo '<li class="nav-item py-2"><input class="form-control fw-bold btn-outline-light" id="log-but" type="submit" value="Přihlásit"></li>';
          echo '<li class="nav-item d-flex justify-content-center"><a class="nav-link" id="regi" href="registrace.php">Registrace</a></li>';
          echo '</form>';
        }
       ?>
          </ul>
        </li>
        </ul>
    </div>
  </div>
</nav>
<?php
          if(isset($_SESSION["msg-bad"])){
            echo '
            <div class="d-flex justify-content-center">
                  <div class="alert alert-danger" role="alert">
                  '.$_SESSION["msg-bad"].'
                  </div>
                </div>
            ';
            $_SESSION['msg-bad']=NULL;
          }
          if(isset($_SESSION["msg-good"])){
            echo '
            <div class="d-flex justify-content-center">
                  <div class="alert alert-success" role="alert">
                  '.$_SESSION["msg-good"].'
                  </div>
                </div>
            ';
            $_SESSION['msg-good']=NULL;
          }
?>
