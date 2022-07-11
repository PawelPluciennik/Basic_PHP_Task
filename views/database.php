<html>
<body>
    <?php

    use App\FormHandler;
    
    foreach($dbvalue['parentTable'] as $parent){ ?>
    <h2>Family</h2>
    <ul>
        <li> <?= "Name: " . $parent['name']?> </li>
        <li> <?= "Surname: " . $parent['surname'] ?> </li>
        <ul>
            <?php
            foreach($dbvalue['childTable'][$parent['id']] as $name){
            ?>
                <form method="post" action="/database/deleteChild?id=<?=$name['id']?>">
                    <li> <?= "Child name: " . $name['name']?>
                    <input type="submit" name="delchild-btn" value='Delete child'></li>
                </form>
            <?php
            }
            ?>
        </ul>
    </ul>
    <form method="post" action="/database/edit?id=<?=$parent['id']?>">
        <input type="submit" name="edit-btn" value='Edit'>
    </form>
    <form method="post" action="/database/deleteFamily?id=<?=$parent['id']?>">
        <input type="submit" name="del-btn" value='Delete'>
    </form>
        <br>        
    <?php
    }
    ?>
    <a href="/">Home</a> 
</body>
</html> 