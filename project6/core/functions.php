<?php

function getFromRequest($name, $default = null) {
    return $_REQUEST[$name] ?? $default;
}

function redirectTo($action = '') {
    $url = _APP_URL . '/index.php';
    if ($action) {
        $url .= '?action=' . urlencode($action);
    }
    header("Location: $url");
    exit();
}
