<?php
require_once __DIR__ . '/config.php';

use Smarty\Smarty; 

spl_autoload_register(function ($class) {

    $paths = [
        _ROOT_PATH . '/app/controllers/',           
        _ROOT_PATH . '/app/security/',      
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.class.php';
        
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    

});

session_start();

require_once _ROOT_PATH . '/core/functions.php';

if (!isset($msgs)) {
    $msgs = new Messages();
}

require_once _ROOT_PATH . '/Smarty.class.php';
$smarty = new Smarty();

$smarty->setTemplateDir(_ROOT_PATH . '/app/views/templates'); 
$smarty->setCompileDir(_ROOT_PATH . '/templates_c');           
$smarty->setCacheDir(_ROOT_PATH . '/cache');                   
