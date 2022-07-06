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

    $query = "SELECT id, name, surname FROM parents ORDER BY id ASC";
    $parentsQuery = mysqli_query($conn, $query);
    $parents = [];

    $querychld = "SELECT parent_id, name FROM children ORDER BY parent_id ASC";
    $childrenQuery = mysqli_query($conn, $querychld);
    $children = [];
    
    while(($parentTable = mysqli_fetch_array($parentsQuery, MYSQLI_ASSOC)) != null) {
        $parents[] = $parentTable;
    }
    while(($childrenTable = mysqli_fetch_array($childrenQuery, MYSQLI_ASSOC)) != null) {
        $children[] = $childrenTable;
    }

    $allchildrens = [];
    foreach($children as $child){
        if(empty($allchildrens[$child["parent_id"]] )) {
            $allchildrens[$child["parent_id"]]  = [];
        }
        $allchildrens[$child["parent_id"]][] = $child;
    }
    
    foreach($parents as $parent){
        echo "Name: " . $parent["name"] . "<br> Surname: " . $parent["surname"] . "<br><br>";
        foreach($allchildrens[$parent['id']] as $name){
            if(!empty($name['name'])) echo "Child name: " . $name['name'] . "<br>";
        }
        echo "<br>";
    }    
?>
</body>
</html> 