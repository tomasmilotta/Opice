<?php
  $file1 = basename($_GET["file"]);
  $file = $_GET["path"].$file1;
  $autor = $_GET["autor"];
  $filename = $autor."_".$file1;

  if(!file_exists($file)){
    die ('soubor neexistuje');
    header("location:spravaClanku.php");
  }else{
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    readfile($file);
    header("location:spravaClanku.php");
  }
 ?>
