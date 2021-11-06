<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = "select * from users join roles on users.user_role = roles.role_id";
  $vysledek = mysqli_query($spojeni, $dotaz);
  //test výpisu dat z databáze
  echo "<table border=1>";
  echo "<tr><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Login</th><th>Role</th><th>E-mail</th></tr>";
  while($radek = mysqli_fetch_assoc($vysledek)){
    $ukazheslo = $radek['user_login']."84oasů.f+A;Sa>wˇe8'(f4y6";
    $heslo6 = hash("sha256",$ukazheslo);
    echo $radek['user_login']."|".$heslo6."<br>";
    echo "<tr>";
    echo "<td>".$radek['user_id']."</td>";
    echo "<td>".$radek['user_name']."</td>";
    echo "<td>".$radek['user_sname']."</td>";
    echo "<td>".$radek['user_login']."</td>";
    echo "<td>".$radek['role_name']."</td>";
    echo "<td>".$radek['user_email']."</td>";
    echo "</tr>";
  }
  echo "</table>";
 ?>
 <?php
   require "footer.php";
  ?>
