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
  if(isset($_POST["smazat"])){
    if($_POST["smazat"]=="Ano"){
      $dotaz = "delete from users where user_id=".$_POST["id"];
      echo $dotaz;
      $vysledek = mysqli_query($spojeni, $dotaz);
      if($vysledek){
        header("location:spravaUzivatelu.php");
      }
    }else if($_POST["smazat"]=="Ne"){
      header("location:spravaUzivatelu.php");
    }
  }
 ?>
  <h3 align="center">Mazání uživatele</h3>
 <form action="deleteUzivatel.php" method="post">
 <div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
   <table>
     <tr>
       <td>ID</td><td><input type="text" name="id" value="<?php echo $id;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Jméno</td><td><input type="text" value="<?php echo $jmeno;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Příjmení</td><td><input type="text" value="<?php echo $prijmeni;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Login</td><td><input type="text" value="<?php echo $login;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>E-mail</td><td><input type="text" value="<?php echo $email;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td colspan="2" align="center">Opravdu chcete smazat uživatele?</td>
     </tr>
     <tr>
       <td colspan="2" align="center"><input type="submit" name="smazat" value="Ano" id="reg-but">&nbsp;<input type="submit" name="smazat" value="Ne" id="reg-but"></td>
     </tr>
   </table>
</div>
</div>
 </form>
<?php
  require "footer.php";
 ?>
