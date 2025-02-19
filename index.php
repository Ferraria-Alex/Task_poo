<?php
session_start();

include './env.php';
include './utils/common.php';
include './abstracts/abstractModel.php';
include './abstracts/abstractController.php';
include './interfaces/interfaceView.php';
include './interfaces/interfaceDb.php';
include './utils/mySqlDb.php';
include './views/view_header.php';
include './views/view_footer.php';
include './views/view_account.php';
include './views/view_MyAccount.php';
include './models/modelAccount.php';
include './controllers/accountController.php';
include './controllers/myAccountController.php';
include './controllers/decoController.php';

$url = parse_url($_SERVER['REQUEST_URI']);

$path = isset($url['path']) ? $url['path'] : '/task_poo/';

switch($path){
    case '/task_poo/' :
        $home = new AccountController();
        $home->setListModels(['accountModel'=> new AccountModel()])->setListViews(['header'=>new HeaderView(),'footer'=> new FooterView(), 'accueil' => new AccountView()]);
        $home->render();
        break;
    
    case '/task_poo/moncompte' :
        $myAccount = new MyAccountController();
        $myAccount->setListModels(null)->setListViews(['header'=>new HeaderView(),'footer'=> new FooterView(), 'myAccount' => new MyAccountView()]);
        $myAccount->render();
        break ;

    case '/task_poo/deconnexion' :
        $deconnexion = new DecoController();
        $deconnexion->deconnexion();
        break;
}