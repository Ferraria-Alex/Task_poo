<?php
class MyAccountController extends AbstractController {
    public function render():void{
        if(!isset($_SESSION['id'])){
            header('location:/task_poo/');
            exit;
        }
        $this->renderHeader();
        echo $this->getListViews()['myAccount']->displayView();
        $this->renderFooter();
    }
}


