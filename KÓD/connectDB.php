<?php
  //Hosting broz.lol
  $servername = "127.0.0.1";
  $username = "broz.lol";
  $password = "LpQ4pbQKf4zg";
  $dbname = "brozlol1";

  //testovací domácí XAMPP
  //$servername = "127.0.0.1";
  //$username = "root";
  //$password = "";
  //$dbname = "opice";
  $spojeni = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_set_charset($spojeni, "utf8");
 ?>
