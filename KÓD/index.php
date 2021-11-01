<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = "select * from users join roles on users.user_role = roles.role_id";
  $vysledek = mysqli_query($spojeni, $dotaz);
  //test výpisu dat z databáze
  echo "<table border=1>";
  echo "<tr><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Login</th><th>Role</th><th>E-mail</th></tr>";
  while($radek = mysqli_fetch_assoc($vysledek)){
    echo "<tr>";
    //echo "ID: ".$radek["user_id"]." Jméno: ".$radek["user_name"]." Příjmení: ".$radek["user_sname"]." Login: ".$radek["user_sname"]." Role v systému: ".$radek["role_name"]." E-mail: ".$radek["user_email"]."<br>";
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
