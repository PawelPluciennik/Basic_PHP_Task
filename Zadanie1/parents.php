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
           
    $all = "SELECT `parents`.`name`, `surname`, `children`.`name` FROM `parents` JOIN `children` ON `parents`.`id`=`children`.`id`"; 
    //$all = "SELECT * FROM `parent`"; //TODO

    $result = mysqli_query($conn, $all);
    

    if (mysqli_num_rows($result) > 0) {
        // OUTPUT DATA OF EACH ROW
        while($row = mysqli_fetch_assoc($result)) {
            echo "Roll No: " . $row["Roll_No"]
            . " - Name: " . $row["Name"]. "<br>";
        }
    } else {
        echo "0 results";
    }
?>