<?php
require_once dirname(__FILE__).'/../../config.php';

session_start();
session_destroy();

header("Location: " . _APP_URL . "/index.html"); // Перенаправление на index.html
exit();
?>