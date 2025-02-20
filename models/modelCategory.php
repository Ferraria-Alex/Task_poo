<?php

class CategoryModel extends AbstractModel {
    private ?int $id;
    private ?string $name;

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }
    
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }
    
    public function add():void{
        try {

            $db = $this->getDb()->connexion();
            $requete = "INSERT INTO category(name) VALUE(?)";
            $req = $db->prepare($requete);
            $req->bindParam(1, $this->name, PDO::PARAM_STR);
            $req->execute();

        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function update():void{
        try {

            $db = $this->getDb()->connexion();
            $requete = "UPDATE category SET name=? WHERE id_category=?";
            $req = $db->prepare($requete);
            $req->bindParam(1, $this->id, PDO::PARAM_STR);
            $req->bindParam(2, $this->name, PDO::PARAM_STR);
            $req->execute();

        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function delete():void{

        try {

            $db = $this->getDb()->connexion();
            $requete = "DELETE FROM category WHERE name = ?";
            $req = $db->prepare($requete);
            $req->bindParam(1, $this->name, PDO::PARAM_STR);
            $req->execute();

        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function getAll():?array{
        try {
            $db = $this->getDb()->connexion();
            $requete = "SELECT id_account, firstname, lastname, email FROM account";
            $req = $db->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getById():?array{
        try {

            $db = $this->getDb()->connexion();
            $requete = "SELECT id_category, name FROM category WHERE id_category=?";
            $req = $db->prepare($requete);
            $req->bindParam(1, $this->id, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;

        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }

    public function getCategoryByName():array | bool | null{
        try {

            $db = $this->getDb()->connexion();
            $requete = "SELECT id_category, name FROM category WHERE name=?";
            $req = $db->prepare($requete);
            $req->bindParam(1, $this->name, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;

        } catch (Exception $e) {
            echo "Erreur" . $e->getMessage();
        }
    }
}