<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<body>

<form method="post" action="/form/result">
  Imie: <input type="text" name="fname"> <br>
  Nazwisko: <input type="text" name="fsurname"> <br>
  Dzieci:   
    <ul>
        <li><input type="text" name="child[]"></li>
        <li><input type="text" name="child[]"></li>
        <li><input type="text" name="child[]"></li>
    </ul> 
  
  <input type="submit" name="submit-btn" value='Send'> <br>
  <a href="/">Back</a> 
  <?php
    if(isset($_POST['submit-btn'])){
      header("/form/result");
    exit;
    }
  ?>
</form>
</body>
</html> 