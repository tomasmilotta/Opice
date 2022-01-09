<?php
  require "header.php";
  require "connectDB.php";
?>
<h1 align="center">Zapomenuté heslo</h1>

<div class="d-flex justify-content-center mb-3">
     <div class="d-inline-flex" id="reg">
<form action="sendPass.php" method="post">
  <table>
    <tr>
      <td>Váš email nebo login</td><td> <input type="text" name="input" required class="form-control"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"> <input type="submit" value="Odeslat" id="reg-but"></td>
    </tr>
  </table>
</form>

</div>
</div>
<?php
  require "footer.php";
?>
