<?php
require_once dirname(__FILE__).'/config.php';
session_start();
$login = $_POST['login'];
$pass = $_POST['pass'];

if (($login === 'user' && $pass === 'user') || ($login === 'admin' && $pass === 'admin')) {
    $_SESSION['logged_in'] = true;
    $_SESSION['role'] = ($login === 'admin') ? 'admin' : 'user';
    header("Location: " . _APP_URL . "/app/calc_view.php");
    exit();
} else {
    header("Location: " . _APP_URL . "/index.php?error=1");
    exit();
}
?>