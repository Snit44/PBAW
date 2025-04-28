<?php
namespace App\Controllers;
use App\Views\LoginView;
class LoginCtrl {
    private $login;
    private $pass;
    private $error;
    public function __construct() {
        if(session_status()===PHP_SESSION_NONE) { session_start(); }
        $this->login = $_POST['login'] ?? '';
        $this->pass = $_POST['pass'] ?? '';
        $this->error = '';
    }
    public function process() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(empty($this->login) || empty($this->pass)){
                $this->error = "Login i hasło są wymagane.";
            } elseif(
              ($this->login === 'admin' && $this->pass === 'admin') ||
              ($this->login === 'user' && $this->pass === 'user')
            ){
                $_SESSION['logged_in'] = true;
                $_SESSION['role'] = ($this->login==='admin') ? 'admin' : 'user';
                header("Location: " . _APP_URL . "/index.php");
                exit();
            } else {
                $this->error = "Nieprawidłowy login lub hasło.";
            }
        }
        $view = new LoginView();
        $view->render($this->error, $this->login);
    }
}
