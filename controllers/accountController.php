<?php

class AccountController extends AbstractController {

    public function displayForm(?string $message = '', ?string $messageSignIn = ''):string {
        if(!isset($_SESSION['id'])){
            return '
            <section>
                <h1>Inscription</h1>
                <form action="" method="post">
                    <input type="text" name="lastname" placeholder="Le Nom de Famille">
                    <input type="text" name="firstname" placeholder="Le Prénom">
                    <input type="text" name="email" placeholder="L\'Email">
                    <input type="password" name="password" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignUp">
                </form>
                <p>'. $message .'</p>
            </section>
            <section>
                <h1>Connexion</h1>
                <form action="" method="post">
                    <input type="text" name="emailSignIn" placeholder="L\'Email">
                    <input type="password" name="passwordSignIn" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignIn">
                </form>
                <p>'.$messageSignIn.'</p>
            </section>';
        }
        return '';
    }
    
    public function displayAccount():string{

        $db = new Db;
        $data = $this->getListModels()['accountModel']->setDb($db)->getAll();

        $listUsers = "";
        foreach($data as $account){
            $listUsers = $listUsers."<li><h2>".$account['firstname'] ." ". $account['lastname']."</h2><p>".$account['email']."</p></li>";
        }
        return $listUsers;
    }

    public function signUp():string{
        if(isset($_POST['submitSignUp'])){
            if(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password'])){
                return "Veuillez remplir les champs !";
            }
    
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
    
            $lastname = clean($_POST['lastname']);
            $firstname = clean($_POST['firstname']);
            $email = clean($_POST['email']);
            $password = clean($_POST['password']);
    
            $password = password_hash($password, PASSWORD_BCRYPT);
    
            $db = new Db;

            if(!empty($this->getListModels()['accountModel']->setDb($db)->setEmail($email)->getAccountByEmail())){
                return "Cet email existe déjà !";
            }
    
            $account = [$firstname, $lastname, $email, $password];
            $this->getListModels()['accountModel']->setDb($db)->setAccount($account)->add();
        
            return "$firstname $lastname a été enregistré avec succès !";
        }
        return '';
    }

    public function signIn():string{
        if(isset($_POST['submitSignIn'])){
            if(empty($_POST['emailSignIn']) || empty($_POST['passwordSignIn']) ){
                return 'Veuillez remplir tous les champs';
            }
    
            if(!filter_var($_POST['emailSignIn'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
    
            $email = clean($_POST['emailSignIn']);
            $password = clean($_POST['passwordSignIn']);
    
            $db = new Db;

            $data = $this->getListModels()['accountModel']->setDb($db)->setEmail($email)->getAccountByEmail();
    
            if(empty($data)){
                return 'Email et/ou Mot de Passe incorrect !';
            }
    
            if(!password_verify($password, $data['password'])){
                return 'Email et/ou Mot de Passe incorrect !';
            }
    
            $_SESSION['id'] = $data['id_account'];
            $_SESSION['firstname']= $data['firstname'];
            $_SESSION['lastname']= $data['lastname'];
            $_SESSION['email']= $data['email'];
    
            header('location:/task_poo/');
            exit;
    
            return $_SESSION['firstname']. " ".$_SESSION['lastname']." est connecté !";
        }
        return '';
    }

    public function render():void{
        $this->renderHeader();
        echo $this->getListViews()['accueil']->setForm($this->displayForm($this->signUp(),$this->signIn()))->setListUsers($this->displayAccount())->displayView();
        $this->renderFooter();
    }
}