<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = "select min(clanek_rok), max(clanek_rok) from clanky";
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  $min = $radek["min(clanek_rok)"];
  $max = $radek["max(clanek_rok)"];
  //echo "min:".$min."|max:".$max;
  echo "<ul>";
  do{
    echo "<li>Rok ".$min."</li>";
    echo "<ul>";
    $dotaz="select min(clanek_vydani), max(clanek_vydani) from clanky where clanek_rok=".$min;
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $min_vydani = $radek["min(clanek_vydani)"];
    $max_vydani = $radek["max(clanek_vydani)"];
    do{
      echo "<li>Vydání: ".$min_vydani."</li>";
      echo "<ul>";
      $dotaz = "select clanek_nazev,clanek_verze,user_login from clanky join users on users.user_id=clanky.clanek_autor where clanek_rok=".$min." and clanek_vydani=".$min_vydani;
      //echo $dotaz."<br>";
      $vysledek = mysqli_query($spojeni, $dotaz);
      while($radek = mysqli_fetch_assoc($vysledek)){
        $path = "clanky/".$radek["user_login"]."/".str_replace(" ","_",$radek["clanek_nazev"])."/v".$radek["clanek_verze"]."/";
        if($handle = opendir($path)){
          while(false != ($entry = readdir($handle))){
            if($entry != "." && $entry != ".."){
              echo '<li>'.$radek["clanek_nazev"].'  <a href="download.php?file='.$entry.'&path='.$path.'&autor='.$radek["user_login"].'">&#128190; Stáhnout</a></li>';
            }
          }
          closedir($handle);
        }else{
           echo '<li>Není soubor</li>';
        }
      }
      echo "</ul>";
      $min_vydani++;
    }while($min_vydani<=$max_vydani);
    echo "</ul>";
    $min++;
  }while($min<=$max);
  echo "</ul>"
 ?>
<?php
  require "footer.php";
 ?>
