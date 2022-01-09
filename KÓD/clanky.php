<?php
  require "header.php";
  require "connectDB.php";
  $dotaz = "select min(clanek_rok), max(clanek_rok) from clanky";
  $vysledek = mysqli_query($spojeni, $dotaz);
  $radek = mysqli_fetch_assoc($vysledek);
  $min = $radek["min(clanek_rok)"];
  $max = $radek["max(clanek_rok)"];
  //echo "min:".$min."|max:".$max;
  
  do{
    echo '<h2 class="display-3 karta" align="center" data-bs-toggle="collapse" href="#collapse'.$min.'" role="button" aria-expanded="false" aria-controls="collapse'.$min.'">Rok '.$min.' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
  </svg></h2>';
    
    $dotaz="select min(clanek_vydani), max(clanek_vydani) from clanky where clanek_rok=".$min;
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $min_vydani = $radek["min(clanek_vydani)"];
    $max_vydani = $radek["max(clanek_vydani)"];
    echo '<div class="collapse" id="collapse'.$min.'">';
    echo '<div class="container">';
    echo '<div class="row justify-content-md-center" align="center">';
    do{
      echo '<div class="col-3">';
      echo '<div class="card">';
      echo '<div class="card-body">';
      echo '<h5 class="card-header">Vydání '.$min_vydani.'</h5>';
      echo '<p class="card-text">';
      $dotaz = "select clanek_nazev,clanek_verze,user_login from clanky join users on users.user_id=clanky.clanek_autor where clanek_rok=".$min." and clanek_vydani=".$min_vydani;
      //echo $dotaz."<br>";
      $vysledek = mysqli_query($spojeni, $dotaz);
      while($radek = mysqli_fetch_assoc($vysledek)){
        $path = "clanky/".$radek["user_login"]."/".str_replace(" ","_",$radek["clanek_nazev"])."/v".$radek["clanek_verze"]."/";
        if($handle = opendir($path)){
          while(false != ($entry = readdir($handle))){
            if($entry != "." && $entry != ".."){
              echo '<div align="left">'.$radek["clanek_nazev"].'  <a class="dwn-btn" href="download.php?file='.$entry.'&path='.$path.'&autor='.$radek["user_login"].'"><svg xmlns="http://www.w3.org/2000/svg" width="23" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
              <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg></a></div>';
            }
          }
          closedir($handle);
        }else{
           echo '<div>Není soubor</div>';
        }
      }
      echo '</p>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      $min_vydani++;
    }while($min_vydani<=$max_vydani);
    echo '</div>';
    echo '</div>';
    echo '</div>';
    $min++;
  }while($min<=$max);
 ?>
<?php
  require "footer.php";
 ?>



