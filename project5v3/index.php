<?php
session_start();
require_once dirname(__FILE__) . '/config.php';
require_once _SECURITY_PATH . '/Security.class.php';

// Проверка авторизации
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: " . _APP_URL . "/index.html");
    exit();
}

// Проверка наличия роли
Security::checkAccess();

// Запуск контроллера калькулятора
require_once _CONTROLLER_PATH . '/CalcCtrl.class.php';
$ctrl = new CalcCtrl();
$action = $_GET['action'] ?? 'show';

if ($action === 'calcCompute') {
    $ctrl->getParams();
    if ($ctrl->validate()) {
        $ctrl->process();
    }
}

$ctrl->generateView();
?>
