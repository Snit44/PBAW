<?php
namespace App\Core;
class ClassLoader {
    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    public static function autoload($className) {
        $prefix = 'App\\';
        if (strpos($className, $prefix) === 0) {
            $className = substr($className, strlen($prefix));
        }
        $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $classPath . '.class.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
