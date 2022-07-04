<?php
    session_start();
    $_SESSION["name"] = $_POST['fname'];
    $_SESSION["surname"] = $_POST['fsurname'];
    $_SESSION["children"] = $_POST['child'];

    var_dump($_SESSION["name"]);

    if($_SESSION["children"] != null) {
        asort($_SESSION["children"]);
    }
    header("Location: http://localhost/Zadanie1/result.php");
?>