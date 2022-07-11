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
        
        $sesionChildren = [];
        foreach($_SESSION["children"] as $child){
            if(!empty($child)) $sesionChildren[] = $child;  
        }
        
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
                'children' => $sesionChildren,
            ]
        );

        return View::make('result');
    }
    public static function readdb(): View {
        $parentModel = new Parentus();
        $childrenModel = new Children();

        $parentTable = $parentModel->getParents();
        $childTable = $childrenModel->getChildren();
        return View::make('database', ['dbvalue' => compact('parentTable','childTable')]);
    }

    public static function getFamily($array): View {
        $parentModel = new Parentus();
        $childrenModel = new Children();

        $parentTable = $parentModel->getParent($array['id']);
        $childTable = $childrenModel->getChild($array['id']);
        return View::make('editFamily', ['familyTable' => compact('parentTable','childTable')]);
    }

    public static function updateFamily($array): View {
        $_SESSION["id"] = $_POST['id'];
        $_SESSION["name"] = $_POST['uname'];
        $_SESSION["surname"] = $_POST['usurname'];
        $_SESSION["children"] = $_POST['uchild'];
        $_SESSION["childenId"] = $_POST['uchild_id'];

        $sesionChildrenId = array_map('intval', $_SESSION["childenId"]);
        $children = array_combine($sesionChildrenId, $_SESSION["children"]);
        
        if($_SESSION["children"] != null) {
            asort($_SESSION["children"]);
        }

        $parentModel = new Parentus();
        $childrenModel = new Children();

        $fam = new AddFamily($parentModel, $childrenModel);
        
        $fam->updateFamily(
            [
                'id' => $_SESSION["id"],
                'name' => $_SESSION["name"],
                'surname' => $_SESSION["surname"],
            ],
            
            $children,
            
        );
        
        $parentTable = $parentModel->getParents();
        $childTable = $childrenModel->getChildren();
        return View::make('database', ['dbvalue' => compact('parentTable','childTable')]);
    }

    public static function deleteFamily($array): View {
        $parentModel = new Parentus();
        $childrenModel = new Children();

        $fam = new AddFamily($parentModel, $childrenModel);
        
        $fam->deleteFamily(
            $array,
            $array,
        );
        
        $parentTable = $parentModel->getParents();
        $childTable = $childrenModel->getChildren();
        return View::make('database', ['dbvalue' => compact('parentTable','childTable')]);
    }

    public static function deleteChild($array): View {
        $parentModel = new Parentus();
        $childrenModel = new Children();
        
        $id = array_map('intval', $array);
        
        $childrenModel->deleteChild($id['id']);
        
        $parentTable = $parentModel->getParents();
        $childTable = $childrenModel->getChildren();
        return View::make('database', ['dbvalue' => compact('parentTable','childTable')]);
    }
}
    
