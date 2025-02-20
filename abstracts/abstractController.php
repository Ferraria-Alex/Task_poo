<?php

abstract class AbstractController {
    
    private ?array $listModels;
    /**
     * $listViews : tableau associatif démarrant avec :
     * [
     *  header => ViewHeader
     *  footer => ViewFooter
     * ]
     */
    private ?array $listViews;

    
    public function getListModels():?array{
        return $this->listModels;
    }
        
    public function getListViews():?array{
        return $this->listViews;
    }

    public function setListModels(?array $listModels):self{
        $this->listModels = $listModels;
        return $this;
    }

    public function setListViews(?array $listViews):self{
        $this->listViews = $listViews;
        return $this;
    }

    public abstract function render():void;

    public function renderHeader():void{
        if(isset($_SESSION['id'])){
            $this->getListViews()['header']->setNav('<a href="/task_poo/moncompte">Mon Compte</a><a href="/task_poo/category">Add Category</a><a href="/task_poo/deconnexion">Se Déconnecter</a>');
        }
        echo $this->getListViews()['header']->displayView();
    }

    public function renderFooter():void{
        echo $this->getListViews()['footer']->displayView();
    }
}