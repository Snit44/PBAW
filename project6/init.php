<?php
require_once __DIR__ . '/config.php';
require_once _SMARTY_DIR . '/libs/Smarty.class.php';
require_once __DIR__ . '/app/Core/ClassLoader.class.php';
\App\Core\ClassLoader::register();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/core/functions.php';
