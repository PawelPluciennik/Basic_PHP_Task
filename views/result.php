<html>
<body>
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
    <a href="/form">Back</a> 
    <a href="/">Home</a> 
</body>
</html> 