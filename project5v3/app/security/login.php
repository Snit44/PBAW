<?php
session_start();
require_once dirname(__FILE__) . '/../../config.php';

$login = $_POST['login'] ?? '';
$pass = $_POST['pass'] ?? '';


if (empty($login) || empty($pass)) {
    $_SESSION['login_error'] = "Login i hasło są wymagane!";
    header("Location: " . _APP_URL . "/index.html#login-section");
    exit();
}

if ($login === 'admin' && $pass === 'admin') {
    $_SESSION['role'] = 'admin';
    $_SESSION['logged_in'] = true;
    header("Location: " . _APP_URL . "/index.php");
    exit();
} elseif ($login === 'user' && $pass === 'user') {
    $_SESSION['role'] = 'user';
    $_SESSION['logged_in'] = true;
    header("Location: " . _APP_URL . "/index.php");
    exit();
} else {
    $_SESSION['login_error'] = "Nieprawidłowy login lub hasło.";
    header("Location: " . _APP_URL . "/index.html#login-section");
    exit();
}
?>
