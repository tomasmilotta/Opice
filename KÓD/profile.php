<?php
  require "header.php";
  require "connectDB.php";
?>
<h1><?php echo $_SESSION["name"]." ".$_SESSION["sname"]?></h1>
<?php
  if(file_exists("img/users/".$_SESSION["login"])){
    echo '<img src="img/users/'.$_SESSION["login"].'/avatar.jpg" width="300px" height="300px">';
  }else{
    echo '<img src="img/users/avatar.jpg" width="300px" height="300px">';
  }
  $dotaz = 'select count(clanek_id) from clanky join users on users.user_id=clanky.clanek_autor where user_login="'.$_SESSION["login"].'";';
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  $pocetClanku = $radek["count(clanek_id)"];
  $dotaz = 'select count(clanek_id) from clanky join users on users.user_id=clanky.clanek_autor where user_login="'.$_SESSION["login"].'" and clanek_vydany = 1';
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  $pocetVydanych = $radek["count(clanek_id)"];
?>
<ul>
  <li>login: <?php echo $_SESSION["login"]?></li>
  <li><a href="changePswd.php">Změnit heslo</a></li>
  <li><a href="updateProfile.php">Upravit profil</a></li>

  <li>Počet článků: <?php echo $pocetClanku?> z toho vydaných - <?php echo $pocetVydanych?></li>
</ul>

<?php
  require "footer.php";
?>
