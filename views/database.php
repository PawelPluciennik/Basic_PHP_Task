<html>
<body>
    <?php 
    foreach($dbvalue['parentTable'][0] as $parent){
    ?>
    <ul>
        <li> <?= "Name: " . $parent['name']?> </li>
        <li> <?= "Surname: " . $parent['surname'] ?> </li>
        <ul>
            <?php 
            foreach($dbvalue['childTable'][$parent['id']] as $name){
                if(!empty($name['name'])) {
            ?>
                    <li> <?= "Child name: " . $name['name']?></li>
            <?php 
                }
            }
            ?>
        </ul>
    </ul><br><br>
    <?php
    }
    ?>
    
    <a href="/">Home</a> 
</body>
</html> 