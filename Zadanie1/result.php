<html>
<body>
    <?php 
        session_start();
    ?>
    <ul>
        <li> <?= ucfirst($_SESSION["name"]); ?> </li>
        <li> <?= ucfirst($_SESSION["surname"]); ?> </li>
        <?php 
        foreach ($_SESSION["children"] as $child){ ?>
            <ul>
                <li> <?= ucfirst($child); ?> </li>
            </ul>
        <?php
        }
        ?>
    </ul>
</body>
</html> 