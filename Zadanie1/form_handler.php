<?php
    session_start();

    $_SESSION["name"] = $_POST['fname'];
    $_SESSION["surname"] = $_POST['fsurname'];
    $_SESSION["children"] = $_POST['child'];

    var_dump($_SESSION["name"]);

    if($_SESSION["children"] != null) {
        asort($_SESSION["children"]);
    }

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
    if(isset($_SESSION["name"]) && isset($_SESSION["surname"])){        
        $par = "INSERT INTO `parents` (`name`, `surname`) VALUES ('" . $_SESSION["name"] . "', '" . $_SESSION["surname"] . "')"; 
        $query = mysqli_query($conn, $par);
        $sqlQuery = 'INSERT INTO `children` (`parent_id`, `name`) VALUES';
        $parentId = mysqli_insert_id($conn);
        foreach ($_SESSION["children"] as $child) {
            $sqlQuery.= "('" . $parentID . "', '" . $child . "'),";
        }
        $sqlQuery = substr($sqlQuery,0,-1);
        $query = mysqli_query($conn, $sqlQuery);
    }   
    
    header("Location: result.php");
?>