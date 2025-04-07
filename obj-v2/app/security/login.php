<?php
require_once dirname(__FILE__).'/../../config.php';
require_once _SMARTY_PATH . '/Smarty.class.php';

use Smarty\Smarty;
$smarty = new Smarty();
$smarty->setTemplateDir(_ROOT_PATH . '/templates');
$smarty->setCompileDir(_ROOT_PATH . '/templates_c');
$smarty->setCacheDir(_ROOT_PATH . '/cache');

function getParamsLogin(&$form){
    $form['login'] = isset($_REQUEST['login']) ? $_REQUEST['login'] : null;
    $form['pass'] = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;
}

function validateLogin(&$form, &$messages){
    if (!(isset($form['login']) && isset($form['pass']))) {
        return false;
    }
    if ($form['login'] == "") {
        $messages[] = 'Nie podano loginu';
    }
    if ($form['pass'] == "") {
        $messages[] = 'Nie podano hasła';
    }
    if (count($messages) > 0) return false;
    if ($form['login'] == "admin" && $form['pass'] == "admin") {
        session_start();
        $_SESSION['role'] = 'admin';
        return true;
    }
    if ($form['login'] == "user" && $form['pass'] == "user") {
        session_start();
        $_SESSION['role'] = 'user';
        return true;
    }
    $messages[] = 'Niepoprawny login lub hasło';
    return false; 
}

$form = array();
$messages = array();

getParamsLogin($form);

if (!validateLogin($form, $messages)) {

    $smarty->assign('messages', $messages);
    $smarty->assign('form', $form);
    $smarty->display('login.tpl');
} else {
    header("Location: " . _APP_URL . "/app/calc.php");
    exit(); 
}
?>