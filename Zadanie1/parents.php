<!DOCTYPE html>
<html>
<body>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    $retval = mysqli_select_db( $conn, 'family' );
    if(! $retval ) {
        die('Could not select database: ' . mysqli_error($conn));
    }

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $retval = mysqli_select_db( $conn, 'family' );

    //$all = "SELECT p.id, p.name, p.surname, c.name AS childname FROM parents p JOIN children c ON p.id=c.parent_id;";
    $par = "SELECT id, name, surname FROM parents";
    $result = mysqli_query($conn, $par);
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "Name: " . $row["name"] . "<br> Surname: " . $row["surname"] . "<br><br>";

            $chld = "SELECT name FROM children WHERE parent_id=" . $row["id"];
            $reschild = mysqli_query($conn, $chld);
            while($rowchld = mysqli_fetch_assoc($reschild)){
                if(!empty($rowchld["name"])) echo "Child Name: " . $rowchld["name"] . "<br>";
            }
            echo "<br>";
        }
    } 
    else {
        echo "0 results";
    }

    
?>
</body>
</html> 