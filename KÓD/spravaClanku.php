<?php
  require "header.php";
  require "connectDB.php";
  if(isset($_SESSION['chyba'])){
    if($_SESSION['chyba']==0){
      echo "<script type='text/javascript'>alert('Úspěch!');</script>";
      unset($_SESSION['chyba']);
    }else{
      echo "<script type='text/javascript'>alert('Chyba při nahrávání souboru!');</script>";
      unset($_SESSION['chyba']);
    }
  }
  if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
    if($role==3){
      echo '<a href="pridatClanek.php">Přidat článek</a>';
      //výpis článků
      echo "<table border=1>";
      echo "<tr>";
      echo "<th>Název článku</th><th>Obsah článku</th><th>Stav článku</th><th>Verze článku</th><th>Zpráva od redaktora</th><th>Posudek recenzenta</th><th>Schválený</th><th>Vydaný</th><th>Číslo vydání</th><th>Reagovat</th>";
      $dotaz = "SELECT * FROM clanky join users on users.user_id=clanky.clanek_autor join stavy on stavy.stav_id=clanky.clanek_stav where user_id = ".$_SESSION['user_id'].";";
    }else{
      $dotaz = "SELECT * FROM clanky join users on users.user_id=clanky.clanek_autor join stavy on stavy.stav_id=clanky.clanek_stav order by clanek_stav";
      //výpis článků
      echo "<table border=1>";
      echo "<tr>";
      echo "<th>ID</th><th>Název článku</th><th>Obsah článku</th><th>Stav článku</th><th>Verze článku</th><th>Zpráva od redaktora</th><th>Posudek recenzenta</th><th>Schválený</th><th>Vydaný</th><th>Číslo vydání</th><th></th><th></th><th></th>";
    }
    $vysledek = mysqli_query($spojeni, $dotaz);
    echo "</tr>";
    while($radek = mysqli_fetch_assoc($vysledek)){
      echo "<tr>";
      if(isset($role) && $role!=3)echo "<td align = center>".$radek['clanek_id']."</td>";
      echo "<td>".$radek['clanek_nazev']."</td>";
      echo '<td><a href="">'.$radek['clanek_obsah'].'</a></td>';//TODO: stažení souboru
      echo "<td>".$radek['stav_popis']."</td>";
      echo "<td align = center>".$radek['clanek_verze']."</td>";
      echo "<td>".$radek['clanek_zpravaRedaktora']."</td>";
      echo "<td>".$radek['clanek_zpravaRecenzenta']."</td>";
      echo "<td align = center>";
      if($radek['clanek_schvaleny']==0){
        echo "&#x2716;";
      }else{
        echo "&#10004;";
      }
      echo "</td>";
      echo "<td align = center>";
      if($radek['clanek_vydany']==0){
        echo "&#x2716;";
      }else{
        echo "&#10004;";
      }
      echo "</td>";
      echo "<td align = center>".$radek['clanek_vydani']."</td>";
      if($role == 2 || $role==6 || $role == 7){
        echo '<td><a href="">Upravit</a></td>'; // TODO: upravování článku: upravování stavu na "vydaný"nebo "schálen"
        if($radek['stav_id']==1){
          echo '<td align=center><a href="">Vrátit autorovi</a></td>'; // TODO: odkaz na stránku, kde se bude měnit stav na "vrácen autorovi", bude se měnit zpráva od redaktora
        }else{
          echo '<td align=center>Vyřešeno</td>';
        }
        echo '<td><a href="">Posunout dále</a></td>'; // TODO: posouvá dále recenzentovi... změna stavu na "poslán recenzentovi"
      }
      if($role==3){
        if($radek['stav_id'] == 3){
          echo '<td><a href="updateClanek.php?name='.$radek["clanek_nazev"].'">Reagovat</a></td>';
        }else{
          echo '<td>V pořádku</td>';
        }
      }
      echo "</tr>";
    }
    echo "</table>";
  }else{
    echo "<p>Nejste přihlášený!</p>";
  }

 ?>
 <?php
 require "footer.php";
  ?>
