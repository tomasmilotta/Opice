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
    $_SESSION['msg-bad']="Neplatný email!";
    input.value='';
    return false;
  }
}
</script>

<h3 align=center>Helpdesk</h3>
<div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">


  <table>
  <form action="sendEmail.php" method="post">
    <?php
      if(!isset($_SESSION["login"])){
        echo '<tr>
          <td>Váš e-mail:</td><td><input type="email" name="email" id="mail" onfocusout = "return ValidateEmail()" required class="form-control"></td>
        </tr>';
      }else{
        echo '<tr>
          <td>Váš e-mail:</td><td><input type="email" name="email" value="'.$_SESSION["email"].'" id="mail" onfocusout = "return ValidateEmail()" readonly class="form-control"></td>
        </tr>';
      }
    ?>

    <tr>
      <td>Předmět:</td><td><input type="text" name="predmet" required class="form-control"></td>
    </tr>
    <tr>
      <td>Zpráva:</td><td><textarea name="zprava" required class="form-control"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"> <input type="submit" name="submit" value="Odeslat" id="reg-but"></td>
    </tr>
    </form>
    <tr>
      <td colspan="2" align="center">
    <?php
  if(!isset($_SESSION["login"])){
    echo '<div align="center"><a href="forgotPasswd.php"><button id="reg-but">Zapomenuté heslo</button></a></div>';
  }
  ?>
  </td>
  </tr>
  </table>
  

</div>
</div>
<?php
  require "footer.php";
?>
