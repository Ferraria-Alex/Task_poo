<?php

class CategoryView implements InterfaceView {
    
    private ?string $message;

    public function getMessage():?string{
        return $this->message;
    }

    public function setMessage(?string $message):self{
        $this->message = $message;
        return $this;
    }

    public function displayView():?string{
        ob_start();
?>
    <h1>Ajouter une catégorie</h1>
    <form action="" method="post">
        <label for="name">Saisir le nom de la catégorie</label>
        <input type="text" name="name">
        <input type="submit" value="ajouter" name="submit">
    </form>
    <?= $this->getMessage() ?>
<?php
        return ob_get_clean();
    }
}