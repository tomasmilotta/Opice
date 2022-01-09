<?php
  require "header.php";
  require "connectDB.php";
?>
<h1 align="center"><?php echo $_SESSION["name"]." ".$_SESSION["sname"]?></h1>

<div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
<?php
  if(file_exists("img/users/".$_SESSION["login"])){
    echo '<img src="img/users/'.$_SESSION["login"].'/avatar.jpg" class="avatar">';
  }else{
    echo '<img src="img/users/avatar.jpg" class="avatar">';
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

  <table>
  <form>
  <tr>
  <td>Login:</td><td><input type="text" name="id" value="<?php echo $_SESSION["login"]?>"  readonly class="form-control"></td>
  </tr>
  <tr>
  <td>Počet článků: </td><td><input type="text" name="id" value="<?php echo $pocetClanku?>"  readonly class="form-control"></td>
  </tr>
  <tr>
  <td>Z toho vydaných: </td><td><input type="text" name="id" value="<?php echo $pocetVydanych?>"  readonly class="form-control"></td>
  </tr>
  
  </form>
  <tr align="center">
  <td><a href="changePswd.php"><button id="reg-but">Změnit heslo</button></a></td><td><a href="updateProfile.php"><button id="reg-but">Upravit profil</button></a></td>
  </tr>
  </table>
  
  
  


</div>
</div>
<?php
  require "footer.php";
?>
