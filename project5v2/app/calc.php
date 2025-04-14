<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/app/ctrl/CalcCtrl.class.php';

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['role']) || $_SESSION['role'] == '') {
    header("Location: " . _APP_URL . "/app/login.php"); // Если нет роли, перенаправляем на login.php
    exit();
}

$ctrl = new CalcCtrl();
$ctrl->getParams();

if ($ctrl->validate()) {
    $ctrl->process();
}

$ctrl->generateView();
?>
