<?php
namespace App\Views;
use Smarty\Smarty;
class LoginView {
    private $smarty;
    public function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(_VIEW_PATH);
        $this->smarty->setCompileDir(_ROOT_PATH . '/templates_c');
        $this->smarty->setCacheDir(_ROOT_PATH . '/cache');
    }
    public function render($error='', $login='') {
        $this->smarty->assign('error', $error);
        $this->smarty->assign('login', $login);
        $this->smarty->display('login.tpl');
    }
}
