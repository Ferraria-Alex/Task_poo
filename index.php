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

$url = parse_url($_SERVER['REQUEST_URI']);

$path = isset($url['path']) ? $url['path'] : '/task_poo/';

switch($path){
    case '/task_poo/' :

        include './models/modelAccount.php';
        include './controllers/accountController.php';
        include './views/view_account.php';

        $home = new AccountController();
        $home->setListModels(['accountModel'=> new AccountModel()])->setListViews(['header'=>new HeaderView(),'footer'=> new FooterView(), 'accueil' => new AccountView()]);
        $home->render();

        break;
    
    case '/task_poo/moncompte' :

        include './controllers/myAccountController.php';
        include './views/view_MyAccount.php';

        $myAccount = new MyAccountController();
        $myAccount->setListModels(null)->setListViews(['header'=>new HeaderView(),'footer'=> new FooterView(), 'myAccount' => new MyAccountView()]);
        $myAccount->render();

        break;

    case '/task_poo/category' :

        include './models/modelCategory.php';
        include './controllers/categoryController.php';
        include './views/view_category.php';

        $category = new CategoryController();
        $category->setListModels(['modelCategory'=>new CategoryModel()])->setListViews(['header'=>new HeaderView(),'footer'=> new FooterView(), 'category' => new CategoryView()]);
        $category->render();

        break ;

    case '/task_poo/deconnexion' :

        include './controllers/decoController.php';

        $deconnexion = new DecoController();
        $deconnexion->deconnexion();

        break;

    default :

        include './controllers/errorController.php';
        include './views/view_error.php';
        $error = new ErrorController();
        $error->setListModels(null)->setListViews(['header'=>new HeaderView(),'footer'=> new FooterView(), 'error' => new ErrorView()]);
        $error->render();
        break;
}