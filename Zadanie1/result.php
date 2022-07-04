<html>
<body>
    <?php 
        session_start();
    ?>
    <ul>
        <li> <?php echo ucfirst($_SESSION["name"]); ?> </li>
        <li> <?php echo ucfirst($_SESSION["surname"]); ?> </li>
        <?php 
        foreach ($_SESSION["children"] as $child){ ?>
            <ul>
                <li> <?php echo ucfirst($child); ?> </li>
            </ul>
        <?php
        }
        ?>
    </ul>
</body>
</html> 