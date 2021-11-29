<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2){
    if($_SESSION["role"]!=7){
      if($_SESSION["role"]!=6){
        if($_SESSION["role"]!=4){
          header("location:index.php");
        }
      }
    }
  }
  $userRole = $_SESSION["role"];
  $id = $_GET["id"];
  $dotaz = "select * from clanky join users on clanky.clanek_autor = users.user_id join stavy on clanky.clanek_stav = stavy.stav_id where clanek_id=".$id;
  $dotaz2 = "select * from stavy";
  $vysledek = mysqli_query($spojeni, $dotaz);
  $vysledek2 = mysqli_query($spojeni, $dotaz2);
  $radek = mysqli_fetch_assoc($vysledek);
  if(isset($_GET["submit"])){
    if($_GET["submit"]=="Změnit"){
      if($_GET["stav"]==4){
        $dotaz = 'update clanky set clanek_stav=4, clanek_zpravaRedaktora="'.$_GET["zpravaRedaktora"].'", clanek_zpravaRecenzenta="'.$_GET["zpravaRecenzenta"].'", clanek_zpravaSefredaktora="'.$_GET["zpravaSefredaktora"].'", clanek_vydany=0, clanek_vydani=DEFAULT, clanek_schvaleny=1 where clanek_id ='.$_GET["id"];
      }else if($_GET["stav"]==5){
        if(isset($_GET["vydani"])){
          $vydani = $_GET["vydani"];
        }else $vydani = "NULL";
        $dotaz = 'update clanky set clanek_stav=5, clanek_zpravaRedaktora="'.$_GET["zpravaRedaktora"].'", clanek_zpravaRecenzenta="'.$_GET["zpravaRecenzenta"].'", clanek_zpravaSefredaktora="'.$_GET["zpravaSefredaktora"].'", clanek_vydany=1, clanek_vydani='.$vydani.', clanek_schvaleny=1 where clanek_id ='.$_GET["id"];
        echo $dotaz;
      }else{
        $dotaz = 'update clanky set clanek_stav='.$_GET["stav"].', clanek_zpravaRedaktora="'.$_GET["zpravaRedaktora"].'", clanek_zpravaRecenzenta="'.$_GET["zpravaRecenzenta"].'", clanek_zpravaSefredaktora="'.$_GET["zpravaSefredaktora"].'", clanek_vydany=0, clanek_vydani=DEFAULT, clanek_schvaleny=0 where clanek_id ='.$_GET["id"];
        echo $dotaz;
      }
      if($userRole==4){
        $dotaz = 'update clanky set clanek_stav=1, clanek_zpravaRedaktora="'.$_GET["zpravaRedaktora"].'", clanek_zpravaRecenzenta="'.$_GET["zpravaRecenzenta"].'", clanek_zpravaSefredaktora="'.$_GET["zpravaSefredaktora"].'", clanek_vydany=0, clanek_vydani=DEFAULT, clanek_schvaleny=0 where clanek_id ='.$_GET["id"];
      }
      $vysledek = mysqli_query($spojeni, $dotaz);
      if($vysledek)
      {
        $_SESSION["msg-good"]="Článek úspěšně upraven.";
        header("location:spravaClanku.php");
      }
    }else if($_GET["submit"]=="Zpět"){
      header("location:spravaClanku.php");
    }
  }

 ?>
<h3 align=center>Úprava článku</h3>
<form action="upravitClanek.php" method="get">
<div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
  <table>
    <tr>
      <td>ID</td><td><input type="text" name="id" value="<?php echo $radek["clanek_id"];?>" readonly class="form-control"></td>
    </tr>
    <tr>
      <td>Název článku</td><td><input type="text" name="nazev" value="<?php echo $radek["clanek_nazev"];?>" readonly class="form-control"></td>
    </tr>
    <?php
      if($userRole == 2 || $userRole == 6 || $userRole == 7){
        echo '<tr>
          <td>Stav</td>
          <td>
            <select name="stav" class="form-control">';

              while($stavy = mysqli_fetch_assoc($vysledek2)){
                if($stavy["stav_id"]==$radek["clanek_stav"]){
                  echo '<option value="'.$stavy["stav_id"].'" selected>'.$stavy["stav_popis"].'</option>';
                }else{
                  echo '<option value="'.$stavy["stav_id"].'">'.$stavy["stav_popis"].'</option>';
                }
              }

            echo '</select>
          </td>
        </tr>';
      }else{
        echo '<input type="text" name=stav hidden value="'.$radek["clanek_stav"].'">';
      }
     ?>
       <?php
        if($userRole == 2 || $userRole == 6){
          echo '<tr>';
          echo '<td>Zpráva redaktora</td>';
          echo '<td><textarea name="zpravaRedaktora" rows="5" cols="30" class="form-control" required>'.$radek["clanek_zpravaRedaktora"].'</textarea></td>';
          echo '</tr>';
        }else echo '<textarea name="zpravaRedaktora" hidden>'.$radek["clanek_zpravaRedaktora"].'</textarea>';
        if($userRole == 2 || $userRole == 4){
          echo '<tr>';
          echo '<td>Zpráva recenzenta</td>';
          echo '<td><textarea name="zpravaRecenzenta" rows="5" cols="30" class="form-control" required>'.$radek["clanek_zpravaRecenzenta"].'</textarea></td>';
          echo '</tr>';
        }else echo '<textarea name="zpravaRecenzenta" hidden>'.$radek["clanek_zpravaRecenzenta"].'</textarea>';
        if($userRole == 2 || $userRole == 7){
          echo '<tr>';
          echo '<td>Zpráva šéfredaktora</td>';
          echo '<td><textarea name="zpravaSefredaktora" rows="5" cols="30" class="form-control">'.$radek["clanek_zpravaSefredaktora"].'</textarea></td>';
          echo '</tr>';
        }else echo '<textarea name="zpravaSefredaktora" hidden>'.$radek["clanek_zpravaSefredaktora"].'</textarea>';
        if($userRole == 2 || $userRole == 6 || $userRole == 7){
          if($radek["clanek_vydany"]!=0){
            echo '<tr>';
            echo '<td>Číslo vydání</td>';
            echo '<td><input type="number" name="vydani" value="'.$radek["clanek_vydani"].'"required class="form-control"></td>';
            echo '</tr>';
          }
        }
        ?>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="submit" value="Zpět" id="reg-but"></td>
        </tr>
  </table>
      </div>
      </div>
</form>
<?php
  require "footer.php";
 ?>
