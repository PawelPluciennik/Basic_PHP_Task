<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<body>
<form method="post" action="/database/updated">
  <input type="hidden" name="id" value=<?php echo $familyTable['parentTable'][0]['id'] ?>>
  Imie: <input type="text" name="uname" value=<?php echo $familyTable['parentTable'][0]['name'] ?>> <br>
  Nazwisko: <input type="text" name="usurname" value=<?php echo $familyTable['parentTable'][0]['surname'] ?>> <br>
  Dzieci:   
    <ul>
        <?php 
        foreach($familyTable['childTable'] as $child){
        ?>
        <input type="hidden" name="uchild_id[]" value=<?php echo $child['id'] ?>>
        <li><input type="text" name="uchild[]" value=<?php echo $child['name'] ?>></li>
        <?php  
        }
        ?>
    </ul> 
  
  <input type="submit" name="submit-btn" value='Send'> <br>
  <a href="/">Home</a> 
  <a href="/database">Back</a> 
</form>
</body>
</html> 