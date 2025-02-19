<?php

abstract class AbstractModel {

    private ?InterfaceDb $db;

    public function getDb():?InterfaceDb{
        return $this->db;
    }

    public function setDb(?InterfaceDb $db):self{
        $this->db = $db;
        return $this;
    }

    public abstract function add():void;
    public abstract function update():void;
    public abstract function delete():void;
    public abstract function getAll():?array;
    public abstract function getById():?array;
}