<!DOCTYPE html>
<html>
<body>
<?php
    include_once 'dd.php';

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

    $query = "SELECT id, name, surname FROM parents";
    $parentsQuery = mysqli_query($conn, $query);
    $parents = [];

    $querychld = "SELECT parent_id, name FROM children";
    $childrenQuery = mysqli_query($conn, $querychld);
    $children = [];
    
    while(($parentTable = mysqli_fetch_array($parentsQuery, MYSQLI_ASSOC)) != null) {
        $parents[] = $parentTable;
    }
    while(($childrenTable = mysqli_fetch_array($childrenQuery, MYSQLI_ASSOC)) != null) {
        $children[] = $childrenTable;
    }

    foreach($parents as $parent){
        echo "Name: " . $parent["name"] . "<br> Surname: " . $parent["surname"] . "<br><br>";
        foreach($children as $child){
            if($child["parent_id"] == $parent["id"] && !empty($child["name"]))echo "Child name: " . $child["name"] . "<br>";
        }
        echo "<br>";
    }    
?>
</body>
</html> 