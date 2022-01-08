<?php
  require "header.php";
  require "connectDB.php";
?>
<h1>Zapomenuté heslo:</h1>
<form action="sendPass.php" method="post">
  <table>
    <tr>
      <td>Váš email nebo login</td><td> <input type="text" name="input" required></td>
    </tr>
    <tr>
      <td colspan="2"> <input type="submit"> </td>
    </tr>
  </table>
</form>
<?php
  require "footer.php";
?>
