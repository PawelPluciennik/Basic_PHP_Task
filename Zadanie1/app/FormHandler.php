<?php
    session_start();

    use App\View;
    use App\App;
    use App\Model\Parentus;
    use App\Model\Children;
    use App\Models\AddFamily;

class FormHandler{
    
    public function index() :View{
        $db = App::db();

        $_SESSION["name"] = $_POST['fname'];
        $_SESSION["surname"] = $_POST['fsurname'];
        $_SESSION["children"] = $_POST['child'];
        
        if($_SESSION["children"] != null) {
            asort($_SESSION["children"]);
        }

        $parentModel = new Parentus();
        $childrenModel = new Children(); 

        (new AddFamily($parentModel, $childrenModel))->add(
            [
                'name' => $_SESSION['name'],
                'surname' => $_SESSION['surname'],
            ],
            [
                'children' => $_SESSION['children'],
            ]
        );

        return View::make('index');
    }
}

    $database->insertFamily($_SESSION["name"], $_SESSION["surname"], $_SESSION["children"]);
    
    header("Location: result.php");
?>