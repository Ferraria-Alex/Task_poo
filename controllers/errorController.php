<?php

class ErrorController extends AbstractController {
    public function render():void{
        $this->renderHeader();
        echo $this->getListViews()['error']->displayView();
        $this->renderFooter();
    }
}