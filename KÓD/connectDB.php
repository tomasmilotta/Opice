<?php
  //školní server
  //servername  = "localhost";
  //$username = "broz07";
  //$password = "Tis*188101";
  //$dbname = "broz07";

  //testovací domácí XAMPP
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "opice";
  $spojeni = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_set_charset($spojeni, "utf8");
 ?>
