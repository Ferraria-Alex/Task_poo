<?php
class AccountView implements InterfaceView{
    private ?string $form = '';
    private ?string $listUsers = '';

    public function getForm(): ?string { 
        return $this->form; 
    }

    public function getListUsers(): ?string { 
        return $this->listUsers; 
    }

    public function setForm(?string $form): self { 
        $this->form = $form; 
        return $this; 
    }

    public function setListUsers(?string $listUsers): self { 
        $this->listUsers = $listUsers; 
        return $this; 
    }

    public function displayView():string{
        ob_start();
        echo $this->getForm();
?>
        <section>
            <h1>Liste d'Utilisateurs</h1>
            <ul>
                <?php echo $this->getListUsers() ?>
            </ul>
        </section>
<?php
        return ob_get_clean();
    }
}