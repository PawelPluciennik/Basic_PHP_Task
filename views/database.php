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
                <li> <?= "Child name: " . $name['name']?></li>
            <?php
            }
            ?>
        </ul>
    </ul>
    <form method="post" action="/database/edit?id=<?=$parent['id']?>">

        <input type="submit" name="edit-btn" value='Edit'>
        <input type="submit" name="del-btn" value='Delete'>
        <br>
        <br>

        <?php
        if(isset($_POST['edit-btn'])){
            header("/database/edit");
            exit;
        }
        if(isset($_POST['del-btn'])){
            header("/form/result");
            exit;
        }
        ?>
        </form>
        <?php
    }
    ?>
    
    
    <a href="/">Home</a> 
</body>
</html> 