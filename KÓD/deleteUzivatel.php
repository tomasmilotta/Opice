<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) {
    header("location:index.php");
  }
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dotaz = "select * from users where user_id=".$id;
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $jmeno = $radek["user_name"];
    $prijmeni = $radek["user_sname"];
    $login = $radek["user_login"];
    $email = $radek["user_email"];
  }else{

  }
 ?>
 <h3 align="center">Mazání uživatele</h3>
 <form action="deleteUzivatel.php" method="post">
 <div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
   <table>
     <tr>
       <td>ID</td><td><input type="text" name="id" value="<?php echo $id;?>" readonly></td>
     </tr>
     <tr>
       <td>Jméno</td><td><input type="text" value="<?php echo $jmeno;?>" readonly></td>
     </tr>
     <tr>
       <td>Příjmení</td><td><input type="text" value="<?php echo $prijmeni;?>" readonly></td>
     </tr>
     <tr>
       <td>Login</td><td><input type="text" value="<?php echo $login;?>" readonly></td>
     </tr>
     <tr>
       <td>E-mail</td><td><input type="text" value="<?php echo $email;?>" readonly></td>
     </tr>
     <tr>
       <td colspan="2" align="center">Opravdu chcete smazat uživatele?</td>
     </tr>
     <tr>
       <td colspan="2" align="center"><input type="submit" name="smazat" value="Ano">&nbsp;<input type="submit" name="smazat" value="Ne"></td>
     </tr>
   </table>
</div>
</div>
 </form>
 <?php
 if(isset($_POST["smazat"])){
   if($_POST["smazat"]=="Ano"){
     $dotaz = "delete from users where user_id=".$_POST["id"];
     echo $dotaz;
     $vysledek = mysqli_query($spojeni, $dotaz);
     if($vysledek){
       //header ("location:spravaUzivatelu.php");
       echo '<script> location.replace("spravaUzivatelu.php"); </script>';
     }
   }else if($_POST["smazat"]=="Ne"){
     //header ("location:spravaUzivatelu.php");
     echo '<script> location.replace("spravaUzivatelu.php"); </script>';
   }
 }
  ?>
<?php
  require "footer.php";
 ?>
