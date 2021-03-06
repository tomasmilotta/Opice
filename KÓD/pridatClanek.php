<?php
  $title = "Přidání článku";
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["login"])){
      header("location:index.php");
  }
  if(isset($_POST['submit'])) {
    $dotaz = 'SELECT COUNT(*) from clanky join users on clanky.clanek_autor = users.user_id where clanek_nazev = "'.$_POST['name'].'";';
    $login = $_SESSION['login'];
    $id = $_SESSION['user_id'];
    $nazev = $_POST['name'];
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $cislo = $radek["COUNT(*)"];
    if($cislo!=0){
        echo "<script type='text/javascript'>alert('Článek s tímto názvem máte již odeslaný!');</script>";
    }else{
      $verze = 1;
      $name =  $_FILES['file']['name'];
      $targetDir = "clanky/".$login."/".str_replace(" ","_",$nazev)."/v".$verze."/";
      if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
      }
      $targetFile = $targetDir.basename($_FILES['file']['name']);
      $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
      if(isset($_POST['submit'])){
        if(move_uploaded_file($_FILES['file']['tmp_name'],$targetDir.$name)){
          session_start();
          $dotaz = 'insert into clanky (clanek_autor, clanek_nazev, clanek_obsah) values("'.$id.'","'.$nazev.'","'.$name.'");';
          mysqli_query($spojeni, $dotaz);
          $_SESSION["msg-good"]="Článek úspěšně přidán.";
          header("location:spravaClanku.php");
        }else{
          session_start();
          $_SESSION["msg-bad"]="Článek nebyl přidán.";
          header("location:pridatClanek.php");
        }
      }
        echo "<script type='text/javascript'>alert('Hotovo!');</script>";
    }
  }
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">
   function fileValidation(){
     var fileInput = document.getElementById('fileToUpload');
     var filePath = fileInput.value;
     var allowed = /(\.doc|\.docx|\.pdf)$/i;
     if (!allowed.exec(filePath)) {
            alert('Nepovolený typ souboru | Podporované typy souborů: .doc, .docx, .pdf');
            fileInput.value = '';
            return false;
        }
   }

 </script>
 <h3 align=center>Přidat článek</h3>
 <div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
 <form action="pridatClanek.php" method="POST" enctype="multipart/form-data">
   <table>
     <tr>
       <td>Název článku:</td><td><input type="text" name="name" required class="form-control"></td>
     </tr>
     <tr>
       <td>Nahrajte soubor:</td><td><input type="file" name="file" id="fileToUpload" accept=".doc, .docx, .pdf" onchange = "return fileValidation()" required class="form-control"></td>
     </tr>
     <tr>
       <td colspan="2" align="center"><input style="width:90%;" type="submit" name="submit" id="reg-but"></td>
     </tr>
   </table>
 </form>
     </div>
 </div>
 <?php
  require "footer.php";
  ?>
