<?php
    session_start();

    use App\DB;

    $database = new DB();

    $_SESSION["name"] = $_POST['fname'];
    $_SESSION["surname"] = $_POST['fsurname'];
    $_SESSION["children"] = $_POST['child'];

    if($_SESSION["children"] != null) {
        asort($_SESSION["children"]);
    }

    $database->insertFamily($_SESSION["name"], $_SESSION["surname"], $_SESSION["children"]);

    //co jeszcze;?
    
    header("Location: result.php");
?>