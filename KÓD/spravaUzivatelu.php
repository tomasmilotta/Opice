<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = "select * from users join roles on users.user_role = roles.role_id";
  $vysledek = mysqli_query($spojeni, $dotaz);
  echo "<table border=1>";
  echo "<tr><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Login</th><th>Role</th><th>E-mail</th><th></th><th></th><th>Resetovat heslo(1234)</th></tr>";
  while($radek = mysqli_fetch_assoc($vysledek)){
    echo "<tr>";
    echo "<td>".$radek['user_id']."</td>";
    echo "<td>".$radek['user_name']."</td>";
    echo "<td>".$radek['user_sname']."</td>";
    echo "<td>".$radek['user_login']."</td>";
    echo "<td>".$radek['role_name']."</td>";
    echo "<td>".$radek['user_email']."</td>";
    echo '<td><a href="updateUzivatel.php?id='.$radek["user_id"].'">Upravit</a></td>';
    echo '<td><a href="deleteUzivatel.php?id='.$radek["user_id"].'">Smazat</a></td>';
    echo '<td><a href="resetHesla.php?id='.$radek["user_id"].'">Resetovat</a></td>';
    echo "</tr>";
  }
  echo "</table>";
 ?>

 <?php
  require "footer.php";
 ?>
