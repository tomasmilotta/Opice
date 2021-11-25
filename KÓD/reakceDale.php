<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["login"])){
      header("location:index.php");
  }
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dotaz = "select * from clanky join users on clanky.clanek_autor=users.user_id where clanek_id=".$id;
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $nazev = $radek["clanek_nazev"];
    $verze = $radek["clanek_verze"];
    $autor = $radek["user_name"].' '.$radek["user_sname"];
  }
 ?>
 <form action="reakceDale.php" method="post">
   <input type="hidden" name="id" value="<?php echo $id;?>">
   <table border="1">
     <tr>
       <td>Název článku</td><td><input type="text" value="<?php echo $nazev;?>" readonly></td>
     </tr>
     <tr>
       <td>Autor</td><td><input type="text" value="<?php echo $autor;?>" readonly></td>
     </tr>
     <tr>
       <td>Verze článku</td><td><input type="text" value="<?php echo $verze;?>" readonly></td>
     </tr>
     <tr>
       <td>Zpráva</td><td><textarea name="zprava" rows="10" cols="40" required></textarea></td>
     </tr>
     <tr>
       <td colspan="2" align="center"><input style="width:90%;" type="submit" name="submit"></td>
     </tr>
   </table>
 </form>
 <?php
 if(isset($_POST['submit'])){
   $dotaz = 'update clanky set clanek_stav=2, clanek_zpravaRedaktora = "'.$_POST["zprava"].'" where clanek_id = '.$_POST["id"].';';
   if(mysqli_query($spojeni, $dotaz)){
     header("location:spravaClanku.php");
   }
 }
  ?>
 <?php
 require "footer.php";
  ?>
