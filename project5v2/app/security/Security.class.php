<?php
class Security {
    public static function checkAccess() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['role'])) {
            header("Location: " . _APP_URL . "/app/security/login.php");
            exit();
        }
    }
}
?>