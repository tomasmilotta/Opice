<?php
  $title = "Přidání článku";
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["login"])){
      header("location:index.php");
  }
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">
   function fileValidation(){
     var fileInput = document.getElementById('file');
     var filePath = fileInput.value;
     var allowed = /(\.doc|\.docx|\.pdf)$/i;
     if (!allowed.exec(filePath)) {
            alert('Nepovolený typ souboru | Podporované typy souborů: .doc, .docx, .pdf');
            fileInput.value = '';
            return false;
        }
   }
 </script>
 <form action="" method="post">
   <table>
     <tr>
       <td>Název článku:</td><td><input type="text" name="nazevClanku" required></td>
     </tr>
     <tr>
       <td>Nahrajde soubor:</td><td><input type="file" name="clanek" id="file" accept=".doc, .docx, .pdf" onchange = "return fileValidation()" required></td>
     </tr>
   </table>
 </form>
 <?php
  require "footer.php";
  ?>
