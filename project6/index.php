<?php
session_start();
require_once 'config.php';
require_once 'init.php';
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: " . _APP_URL . "/index.html#login-section");
    exit();
}
use App\Security\Security;
Security::checkAccess();
use App\Controllers\CalcCtrl;
$ctrl = new CalcCtrl();
$action = $_GET['action'] ?? 'show';
if ($action === 'calcCompute') {
    $ctrl->getParams();
    if ($ctrl->validate()) {
        $ctrl->process();
    }
}
$ctrl->generateView();
