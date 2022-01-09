<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = 'select count(user_id) from users where user_id="'.$_GET["id"].'" and user_passwd="'.$_GET["pass"].'";';
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  if($radek["count(user_id)"]!=1){
    echo '<script>alert("Neplatný odkaz!");window.location.href="index.php";</script>';
  }

 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">
 function checkPasswordMatch() {
     var pass1 = $("#pass1").val();
     var pass2 = $("#pass2").val();
     if (pass1 != pass2)
         $("#stav").html("Hesla se neshodují!");
     else
         $("#stav").html("");
 }
 $(document).ready(function () {
    $("#pass2").keyup(checkPasswordMatch);
    $("#pass1").keyup(checkPasswordMatch);
 });
 </script>
<h1 align="center">Obnova hesla</h1>
<div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
 <form action="recoverPass.php" method="get">
  <table>
    <tr>
      <td>Nové heslo: </td><td> <input type="password" name="pass1" id="pass1" class="form-control"> </td>
    </tr>
    <tr>
      <td>Nové heslo znovu: </td><td> <input type="password" name="pass2" id="pass2" class="form-control"> </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><div id="stav" style="color:red">  </div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"> <input type="submit" name="submit" id="reg-but" value="Změnit"> </td>
    </tr>
  </table>
  <input type="hidden" name="id" value= <?php echo $_GET["id"]?>> <input type="hidden" name="pass" value="<?php echo $_GET["pass"]?>">
 </form>
 </div>
</div>

 <?php
 if(isset($_GET["submit"])){
   if($_GET["pass1"]==$_GET["pass2"] && $_GET["pass1"]!=""){
     $pass = $_GET["pass1"]."84oasů.f+A;Sa>wˇe8'(f4y6";
     $pass = hash("sha256",$pass);
     $dotaz= 'update users set user_passwd="'.$pass.'" where user_id ='.$_GET["id"];
     $vysledek = mysqli_query($spojeni, $dotaz);
     if($vysledek){
       echo '<script>alert("Heslo úspěšně obnoveno!");window.location.href="index.php";</script>';
     }
   }else{
     echo '<script>alert("Hesla se neshodují!");</script>';
   }
 }
 require "footer.php";
 ?>
