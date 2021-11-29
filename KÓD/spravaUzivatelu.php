<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
  $dotaz = "select * from users join roles on users.user_role = roles.role_id";
  $vysledek = mysqli_query($spojeni, $dotaz);
  ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
<?php
  $i=0;
  echo "<table class='w-100 sprava-tab'>";
  echo "<tr class='radek-clanky'><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Login</th><th>Role</th><th>E-mail</th><th></th><th></th><th>Resetovat heslo(1234)</th></tr>";
  while($radek = mysqli_fetch_assoc($vysledek)){
      if (($i%2)==1)
      {
        echo "<tr class='radek-clanky'>";
      }
      else echo "<tr class='radek radek-clanky'>";
    echo "<td>".$radek['user_id']."</td>";
    echo "<td>".$radek['user_name']."</td>";
    echo "<td>".$radek['user_sname']."</td>";
    echo "<td>".$radek['user_login']."</td>";
    echo "<td>".$radek['role_name']."</td>";
    echo "<td>".$radek['user_email']."</td>";
    echo '<td><a href="updateUzivatel.php?id='.$radek["user_id"].'" class="btn">Upravit</a></td>';
    echo '<td><a href="deleteUzivatel.php?id='.$radek["user_id"].'" class="btn">Smazat</a></td>';
    echo '<td><a href="resetHesla.php?id='.$radek["user_id"].'" class="btn">Resetovat</a></td>';
    echo "</tr>";
    $i++;
  }
  echo "</table>";
 ?>
    </div>
  </div>
</div>
 <?php
  require "footer.php";
 ?>
