<?php

class Db implements InterfaceDb {
    public function connexion(): Object {
        return new PDO(
            'mysql:host='.$_ENV['URL_BDD'].';dbname='.$_ENV['NAME_BDD'],
            $_ENV['LOGIN_BDD'],
            $_ENV['PASSWORD_BDD'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}