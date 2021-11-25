<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = "select * from users join roles on users.user_role = roles.role_id";
  $vysledek = mysqli_query($spojeni, $dotaz);
  //test výpisu dat z databáze
  ?>

  <div class="container-fluid">
  <div class="row">
      <div class="col-12">
        <?php
  echo "<table  class='w-100 sprava-tab'>";
  echo "<tr><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Login</th><th>Role</th><th>E-mail</th></tr>";
  while($radek = mysqli_fetch_assoc($vysledek)){
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
    </div>
  </div>
</div>
 <?php
   require "footer.php";
  ?>
