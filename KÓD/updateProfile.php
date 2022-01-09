<?php
  require "header.php";
  require "connectDB.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  function fileValidation(){
    var fileInput = document.getElementById('fileToUpload');
    var filePath = fileInput.value;
    var allowed = /(\.jpg|\.jpeg)$/i;
    if (!allowed.exec(filePath)) {
           alert('Nepovolený typ souboru | Podporované typy souborů: .jpg, .jpeg');
           fileInput.value = '';
           return false;
       }
  }
 </script>
<h3 align="center">Úprava profilu</h3>

<div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">

  <table>
  <form action="updateProfile.php" method="post" enctype="multipart/form-data">
    <tr>
      <td>Jméno:</td><td><input type="text" name="name" value="<?php echo $_SESSION["name"];?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Příjmení:</td><td><input type="text" name="sname" value="<?php echo $_SESSION["sname"];?>" class="form-control"></td>
    </tr>
    <tr>
      <td>E-mail:</td><td><input type="email" name="email" value="<?php echo $_SESSION["email"];?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Avatar:</td><td><input type="file" name="file" id="fileToUpload" accept=".jpg, .jpeg" onchange = "return fileValidation()" required class="form-control"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="Změnit" id="reg-but"></td>
    </tr>
    </form>
    <tr align="center">
    <td colspan="2"><a href="profile.php"><button id="reg-but">Zpět</button></a></td>
    </tr>
  </table>

</div>
</div>
<?php
  if(isset($_POST['submit'])){
    $vzor = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    $email= $_POST["email"];
    $email2 = $_SESSION["email"];
    if(preg_match($vzor, $email)){
      $dotaz = "select count(*) from users where user_email='".$email."';";
      $vysledek = mysqli_query($spojeni, $dotaz);
      $radek = mysqli_fetch_assoc($vysledek);
      $pocetEmail = $radek["count(*)"];
      if($pocetEmail!=1||$email==$email2){
          $dotaz = 'update users set user_name="'.$_POST['name'].'", user_sname="'.$_POST['sname'].'", user_email="'.$_POST['email'].'" where user_id='.$_SESSION['user_id'];
          $vysledek = mysqli_query($spojeni, $dotaz);
          if($vysledek) {
            $name =  $_FILES['file']['name'];
            $targetDir = "img/users/".$_SESSION["login"]."/";
            if (!file_exists($targetDir)) {
              mkdir($targetDir, 0777, true);
            }
            $targetFile = $targetDir.basename($_FILES['file']['name']);
            $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
            move_uploaded_file($_FILES['file']['tmp_name'],$targetDir."avatar.jpg");
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["sname"] = $_POST["sname"];
            $_SESSION["email"] = $_POST["email"];
            echo '<script> location.replace("profile.php"); </script>';
          }
      }else{
        echo '<script>alert("E-mail se již používá!");</script>';
      }
    }else{
      echo '<script>alert("Špatný formát e-mailu!");</script>';
    }

  }
  require "footer.php";
?>
