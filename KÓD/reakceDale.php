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
  if(isset($_POST['submit'])){
    $dotaz = 'update clanky set clanek_stav=2, clanek_zpravaRedaktora = "'.$_POST["zprava"].'" where clanek_id = '.$_POST["id"].';';
    if(mysqli_query($spojeni, $dotaz)){
      header("location:spravaClanku.php");
    }
  }
 ?>
 <h3 align="center">Posunout dále</h3>
 <form action="reakceDale.php" method="post">
 <div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
   <input type="hidden" name="id" value="<?php echo $id;?>">
   <table border="1">
     <tr>
       <td>Název článku</td><td><input type="text" value="<?php echo $nazev;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Autor</td><td><input type="text" value="<?php echo $autor;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Verze článku</td><td><input type="text" value="<?php echo $verze;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Zpráva</td><td><textarea name="zprava" rows="10" cols="40" required class="form-control"></textarea></td>
     </tr>
     <tr>
       <td colspan="2" align="center"><input style="width:90%;" type="submit" name="submit" id="reg-but"></td>
     </tr>
   </table>
</div>
</div>
 </form>
 <?php
 require "footer.php";
  ?>
