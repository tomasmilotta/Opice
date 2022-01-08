<?php
  require "header.php";
  require "connectDB.php";
?>
<script type="text/javascript">
function ValidateEmail() {
  var input = document.getElementById('mail');
  var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  if (input.value.match(validRegex)) {
    return true;
  } else {
    alert("Neplatný e-mail!");
    input.value='';
    return false;
  }
}
</script>
<?php
  if(!isset($_SESSION["login"])){
    echo '<a href="forgotPasswd.php">Zapomenuté heslo</a>' ;
  }
?>
<form action="sendEmail.php" method="post">
  <table>
    <?php
      if(!isset($_SESSION["login"])){
        echo '<tr>
          <td>Váš e-mail:</td><td><input type="email" name="email" id="mail" onfocusout = "return ValidateEmail()" required></td>
        </tr>';
      }else{
        echo '<tr>
          <td>Váš e-mail:</td><td><input type="email" name="email" value="'.$_SESSION["email"].'" id="mail" onfocusout = "return ValidateEmail()" readonly></td>
        </tr>';
      }
    ?>

    <tr>
      <td>Předmět:</td><td><input type="text" name="predmet" required></td>
    </tr>
    <tr>
      <td>Zpráva:</td><td><textarea name="zprava" required></textarea></td>
    </tr>
    <tr>
      <td colspan="2"> <input type="submit" name="submit" value="Odeslat"></td>
    </tr>
  </table>
</form>
<?php
  require "footer.php";
?>
