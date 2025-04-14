<?php
define('_SERVER_NAME', 'localhost:80');
define('_SERVER_URL', 'http://' . _SERVER_NAME);
define('_APP_ROOT', '/project5v2');
define('_APP_URL', _SERVER_URL . _APP_ROOT);
define('_ROOT_PATH', dirname(__FILE__));

define('_APP_PATH', _ROOT_PATH . '/app');
define('_CONTROLLER_PATH', _APP_PATH . '/controllers');
define('_SECURITY_PATH', _APP_PATH . '/security');
define('_VIEW_PATH', _APP_PATH . '/views/templates');
define('_SMARTY_DIR', _ROOT_PATH . '/smarty');
define('_CORE_PATH', _ROOT_PATH . '/core');
define('_ASSETS_PATH', _ROOT_PATH . '/assets');


function out(&$param) {
    if (isset($param)) {
        echo $param;
    }
}
?>