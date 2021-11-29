<?php
  $title = "Upravit článek";
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["login"])){
      header("location:index.php");
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
  <?php
    $nazev = $_GET['name'];
   ?>
  <form action="uploadClanek.php" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Název článku:</td><td><input type="text" name="name" value="<?php echo $nazev;?>" readonly></td>
      </tr>
      <tr>
        <td>Nahrajte soubor:</td><td><input type="file" name="file" id="fileToUpload" accept=".doc, .docx, .pdf" onchange = "return fileValidation()" required></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input style="width:90%;" type="submit" name="submit"></td>
      </tr>
    </table>
  </form>
