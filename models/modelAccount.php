<?php

class AccountModel extends AbstractModel {
    private ?int $id;
    private ?array $account;
    private ?string $email;

    public function getId(): ?int {
        return $this->id;
    }

    public function getAccount(): ?array {
        return $this->account;
    }

    public function getEmail(): ?string {
        return $this->email;
    }
    
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setAccount(?array $account): self {
        $this->account = $account;
        return $this;
    }

    public function setEmail(?string $email): self {
        $this->email = $email;
        return $this;
    }
    
    public function add():void{
        try{
            $db = $this->getDb()->connexion();
            $requete = "INSERT INTO account(firstname, lastname, email, `password`)
            VALUE(?,?,?,?)";
            $req = $db->prepare($requete);
            $req->bindParam(1,$this->account[0], PDO::PARAM_STR);
            $req->bindParam(2,$this->account[1], PDO::PARAM_STR);
            $req->bindParam(3,$this->account[2], PDO::PARAM_STR);
            $req->bindParam(4,$this->account[3], PDO::PARAM_STR);
            $req->execute();
        }
        catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function update():void{
        try {
            $db = $this->getDb()->connexion();
            $requete = "UPDATE account SET firstname=?, lastname=?, email=? 
            WHERE email=?";
            $req = $db->prepare($requete);
            $req->bindParam(1,$this->account[0], PDO::PARAM_STR);
            $req->bindParam(2,$this->account[1], PDO::PARAM_STR);
            $req->bindParam(3,$this->account[3], PDO::PARAM_STR);
            $req->bindParam(4,$this->account[2], PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function delete():void{
        try{
            $db = $this->getDb()->connexion();
            $requete = "DELETE FROM account WHERE email=?";
            $req = $db->prepare($requete);
            $req->bindParam(1,$this->email, PDO::PARAM_STR);
            $req->execute();
        } catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
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
            $requete = "SELECT id_account, firstname, lastname, email, `password` FROM account
            WHERE id_account = ?";
            $req = $db->prepare($requete);
            $req->bindParam(1,$this->id, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getAccountByEmail():array | bool | null{
        try {
            $db = $this->getDb()->connexion();
            $requete = "SELECT id_account, firstname, lastname, email, `password` FROM account
            WHERE email = ?";
            $req = $db->prepare($requete);
            $req->bindParam(1,$this->email, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}