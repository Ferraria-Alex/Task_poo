<?php

class CategoryController extends AbstractController {

    public function addCategory() {
        if(isset($_POST["submit"])) {
            if(!empty($_POST["name"])) {
                $db = new Db;
                $name = clean($_POST["name"]);
                $category = $this->getListModels()['modelCategory']->setDb($db)->setName($name)->getCategoryByName();
                if(!$category) {
                    $this->getListModels()['modelCategory']->setDb($db)->setName($name)->add();
                    return "la catégorie a été ajouté";
                }
                else {
                    return "La catégorie existe déja en BDD";
                } 
            }
        }
    }

    public function render():void{
        $this->renderHeader();
        echo $this->getListViews()['category']->setMessage($this->addCategory())->displayView();
        $this->renderFooter();
    }
}
