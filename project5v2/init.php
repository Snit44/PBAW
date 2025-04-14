<?php
require_once __DIR__ . '/config.php';

// Автозагрузка классов
spl_autoload_register(function ($class) {
    // Пути к папкам с классами
    $paths = [
        _ROOT_PATH . '/app/controllers/',   // контроллеры
        _ROOT_PATH . '/app/lib/',           // вспомогательные библиотеки
        _ROOT_PATH . '/app/security/',      // безопасность
    ];

    // Проверяем каждый путь и пытаемся загрузить класс
    foreach ($paths as $path) {
        // Полный путь к файлу с классом
        $file = $path . $class . '.class.php';
        
        // Если файл существует, подключаем его
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    
    // Если класс не найден, выводим ошибку (можно удалить, если не нужно)
    // echo "Class $class not found!";
});

// Запуск сессии
session_start();

// Подключаем вспомогательные функции
require_once _ROOT_PATH . '/core/functions.php';

// Инициализация сообщений (если еще не инициализировано)
if (!isset($msgs)) {
    $msgs = new Messages();
}

// Инициализация Smarty
require_once _SMARTY_PATH . '/Smarty.class.php';
$smarty = new Smarty();

// Настройка Smarty
$smarty->setTemplateDir(_ROOT_PATH . '/app/views/templates');   // путь к шаблонам
$smarty->setCompileDir(_ROOT_PATH . '/templates_c');            // компиляция шаблонов
$smarty->setCacheDir(_ROOT_PATH . '/cache');                    // кэш шаблонов
