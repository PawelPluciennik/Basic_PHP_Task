<?php
    namespace  App;

    use App\View;
    use App\App;
    use App\Models\Parentus;
    use App\Models\Children;
    use App\Models\AddFamily;

class FormHandler{
    public static function index() :View{
        $db = App::db();

        $_SESSION["name"] = $_POST['fname'];
        $_SESSION["surname"] = $_POST['fsurname'];
        $_SESSION["children"] = $_POST['child'];
        
        if($_SESSION["children"] != null) {
            asort($_SESSION["children"]);
        }

        $parentModel = new Parentus();
        $childrenModel = new Children(); 

        $fam = new AddFamily($parentModel, $childrenModel);

        $fam->add(
            [
                'name' => $_SESSION['name'],
                'surname' => $_SESSION['surname'],
            ],
            [
                'children' => $_SESSION['children'],
            ]
        );

        return View::make('result');
    }
    public static function readdb() :View {
        $parentModel = new Parentus();
        $childrenModel = new Children();

        $parentTable[] = $parentModel->getParents();
        $childTable[] = $childrenModel->getChildren();

        return View::make('database', ['dbvalue' =>compact('parentTable','childTable')]);
    }
}
    
