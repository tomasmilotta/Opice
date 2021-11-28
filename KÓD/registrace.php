<?php
  $title = "Registrace nového autora";
  require "header.php";
  require "connectDB.php";
 ?>
 
 <form action="registrace.php" method="get">
 <div class="d-flex justify-content-center mb-3">
   <div class="d-inline-flex" id="reg">
    <table border = 1 align=center>
     <tr>
       <td>Jméno</td><td><input class="form-control" type="text" name="jmeno" required></td>
     </tr>
     <tr>
       <td>Příjmení</td><td><input class="form-control" type="text" name="prijmeni" required></td>
     </tr>
     <tr>
       <td>Přihlašovací jméno</td><td><input class="form-control" type="text" name="login" required></td>
     </tr>
     <tr>
       <td>E-mail</td><td><input class="form-control" type="email" name="email" required></td>
     </tr>
     <tr>
       <td>Heslo</td><td><input class="form-control" type="password" name="heslo1" required></td>
     </tr>
     <tr>
       <td>Heslo znovu</td><td><input class="form-control" type="password" name="heslo2" required></td>
     </tr>
     <tr>
       <td colspan="2" align=center style="padding-top:20px" ><input style="width:90%" type="submit" name="odeslat" value="Zaregistrovat" id="reg-but"></td>
     </tr>
   </table>
   </div>
   </div>
 </form>

<?php
  if(isset($_GET['odeslat'])){
    $vzor = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    $email= $_GET["email"];
    if(preg_match($vzor, $email)){
      $dotaz = "select count(*) from users where user_login='".$_GET["login"]."';";
      $vysledek = mysqli_query($spojeni, $dotaz);
      $radek = mysqli_fetch_assoc($vysledek);
      $pocetLogin = $radek["count(*)"];
      if($pocetLogin!=1){
        $dotaz = "select count(*) from users where user_email='".$_GET["email"]."';";
        $vysledek = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_assoc($vysledek);
        $pocetEmail = $radek["count(*)"];
        if ($pocetEmail!=1) {
          $pass = $_GET['heslo1'];
          $pass2 = $_GET['heslo2'];
          if ($pass == $pass2) {
            $pass = $pass."84oasů.f+A;Sa>wˇe8'(f4y6";
            $heslo = hash("sha256",$pass);
            $dotaz = 'insert into users (user_name, user_sname, user_login, user_email, user_passwd) values("'.$_GET["jmeno"].'","'.$_GET["prijmeni"].'","'.$_GET["login"].'","'.$_GET["email"].'","'.$heslo.'");';
            $vysledek = mysqli_query($spojeni, $dotaz);
            if($vysledek){
              $dotaz = 'select * from users join roles on roles.role_id = users.user_role where user_login="'.$_GET["login"].'" and user_passwd="'.$heslo.'";';
              $vysledek = mysqli_query($spojeni, $dotaz);
              $loguser = mysqli_fetch_assoc($vysledek);
              $_SESSION["user_id"]=$loguser["user_id"];
              $_SESSION["login"]=$loguser["user_login"];
              $_SESSION["pass"]=$loguser["user_passwd"];
              $_SESSION["name"]=$loguser["user_name"];
              $_SESSION["sname"]=$loguser["user_sname"];
              $_SESSION["role"]=$loguser["user_role"];
              $_SESSION["roleName"]=$loguser["role_name"];
              $_SESSION["email"]=$loguser["user_email"];
              $_SESSION['msg-good']="Uspěšně zaregistrován";
              header("location:index.php");
              exit;
            }else{
                echo '<div class="d-flex justify-content-center">
                <div class="alert alert-danger" role="alert">
                      Chyba registrace!
                </div>      
              </div>';
            }
          }else{
            echo '<div class="d-flex justify-content-center">
                <div class="alert alert-danger" role="alert">
                  Hesla se neshodují!
                </div>      
              </div>';
          }
        }else{
          echo '<div class="d-flex justify-content-center">
          <div class="alert alert-danger" role="alert">
              Email je použitý!
          </div>      
        </div>';
        }
      }else{
        echo '<div class="d-flex justify-content-center">
        <div class="alert alert-danger" role="alert">
        Přihlašovací jméno je již zabrané!
        </div>      
      </div>';
      }
    }else{
      echo '<div class="d-flex justify-content-center">
      <div class="alert alert-danger" role="alert">
      Neplatný formát emailu!
      </div>      
    </div>';
    }
  }
?>
