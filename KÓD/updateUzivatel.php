<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dotaz = "select * from users join roles on users.user_role = roles.role_id where user_id=".$id;
    $dotaz2 = "select * from roles";
    $vysledek = mysqli_query($spojeni, $dotaz);
    $vysledek2 = mysqli_query($spojeni, $dotaz2);
    $radek = mysqli_fetch_assoc($vysledek);
    $jmeno = $radek["user_name"];
    $prijmeni = $radek["user_sname"];
    $login = $radek["user_login"];
    $email2 = $radek["user_email"];
    $role = $radek["role_name"];
    $cisloRole = $radek["user_role"];
  }else{
    //header("location:spravaUzivatelu.php");
  }
  if(isset($_GET["zmenit"])){
    if($_GET["zmenit"]=="Změnit"){
      $vzor = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
      $email= $_GET["email"];
      if(preg_match($vzor, $email)||$email==$email2){
        $dotaz = "select count(*) from users where user_email='".$_GET["email"]."';";
        $vysledek = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_assoc($vysledek);
        $pocetEmail = $radek["count(*)"];
        if($pocetEmail!=1||$email==$email2){
          $dotaz = "select count(*) from users where user_login='".$_GET["login"]."';";
          $vysledek = mysqli_query($spojeni, $dotaz);
          $radek = mysqli_fetch_assoc($vysledek);
          $pocetLogin = $radek["count(*)"];
          if($pocetLogin!=1||$login==$_GET["login"]){
            $dotaz = 'update users set user_name="'.$_GET["jmeno"].'", user_sname="'.$_GET["prijmeni"].'", user_login="'.$_GET["login"].'", user_email="'.$_GET["email"].'", user_role='.$_GET["role"].' where user_id='.$_GET["id"].';';
            $vysledek = mysqli_query($spojeni, $dotaz);
            if($vysledek){
              header("location:spravaUzivatelu.php");
            }else {
              echo '<script>alert("Chyba!");</script>';
            }
          }else{
            echo '<script>alert("Login se již používá!");</script>';
          }
        }else{
          echo '<script>alert("E-mail se již používá!");</script>';
        }
      }else{
        echo '<script>alert("Špatný formát e-mailu!");</script>';
      }
    }else if($_GET["zmenit"]=="Zpět"){
      header("location:spravaUzivatelu.php");
    }
  }
 ?>
 <h3 align="center">Úprava uživatele</h3>
 <form action="updateUzivatel.php" method="get">
   <div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
   <table>
     <tr>
       <td>ID</td><td><input type="text" name="id" value="<?php echo $id;?>" readonly class="form-control"></td>
     </tr>
     <tr>
       <td>Jméno</td><td><input type="text" name="jmeno" value="<?php echo $jmeno;?>" class="form-control"></td>
     </tr>
     <tr>
       <td>Příjmení</td><td><input type="text" name="prijmeni" value="<?php echo $prijmeni;?>" class="form-control"></td>
     </tr>
     <tr>
       <td>Login</td><td><input type="text" name="login" value="<?php echo $login;?>" class="form-control"></td>
     </tr>
     <tr>
       <td>E-mail</td><td><input type="text" name="email" value="<?php echo $email2;?>" class="form-control"></td>
     </tr>
     <tr>
       <td>Role</td>
       <td>
         <select name="role" class="form-control">
           <?php
           //cyklus vypisuje role z databáze a vybere primární roli vybraného uživatele
            while($roles = mysqli_fetch_assoc($vysledek2)){
              if($roles["role_id"]==$cisloRole){
                echo '<option value="'.$roles["role_id"].'" selected>'.$roles["role_name"].'</option>';
              }else{
                echo '<option value="'.$roles["role_id"].'">'.$roles["role_name"].'</option>';
              }
            }
            ?>
         </select>
       </td>
     </tr>
     <tr>
       <td colspan="2" align="center"><input type="submit" name="zmenit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="zmenit" value="Zpět" id="reg-but"></td>
     </tr>
   </table>
      </div>
    </div>
 </form>
 <?php
  require "footer.php";
 ?>
