<?php
class ErrorView implements interfaceView {

    public function displayView():?string{
        ob_start();
        ?>
        <h1>Error 404 : Not found !</h1>
        <?php
        return ob_get_clean();
    }

}