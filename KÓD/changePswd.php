<?php
  require "header.php";
  require "connectDB.php";
?>
<form action="changePswd.php" method="post">
  <table>
    <tr>
      <td>Aktuální heslo:</td><td><input type="password" name="oldpass"></td>
    </tr>
    <tr>
      <td>Nové heslo:</td><td><input type="password" name="pass1"></td>
    </tr>
    <tr>
      <td>Nové heslo znovu:</td><td><input type="password" name="pass2"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="zmenit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="zmenit" value="Zpět" id="reg-but"></td>
    </tr>
  </table>
</form>
<?php
  if(isset($_POST["zmenit"])){
    if($_POST["zmenit"]=="Změnit"){
      $oldpass = $_POST["oldpass"]."84oasů.f+A;Sa>wˇe8'(f4y6";
      $oldpass = hash("sha256",$oldpass);
      if($oldpass ==  $_SESSION["pass"]){
        if($_POST["pass1"]==$_POST["pass2"]){
          $pass = $_POST["pass1"]."84oasů.f+A;Sa>wˇe8'(f4y6";
          $pass = hash("sha256",$pass);
          $dotaz = 'update users set user_passwd="'.$pass.'" where user_id = '.$_SESSION["user_id"];
          //echo $dotaz;
          $vysledek = mysqli_query($spojeni, $dotaz);
          if($vysledek){
            $_SESSION["pass"] = $pass;
            header("location: profile.php");
          }
        }else{
          echo '<script>alert("Nová hesla se neshodují!");</script>';
        }
      }else{
        echo '<script>alert("Aktuální heslo není správné!");</script>';
      }
    }else if($_POST["zmenit"]=="Zpět"){
      header("location:profile.php");
    }
  }
  require "footer.php";
?>
