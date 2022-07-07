<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<body>

<form method="post" action="form_handler.php">
  Imie: <input type="text" name="fname"> <br>
  Nazwisko: <input type="text" name="fsurname"> <br>
  Dzieci:   
    <ul>
        <li><input type="text" name="child[]"></li>
        <li><input type="text" name="child[]"></li>
        <li><input type="text" name="child[]"></li>
    </ul> 
  
  <input type="submit" name="submit-btn" value='Wyślij'>
  <?php
    if(isset($_POST['submit-btn'])){
        header("Location: ../app/form_handler.php");
    exit;
    }
  ?>
</form>
</body>
</html> 