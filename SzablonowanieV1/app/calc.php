<?php
require_once dirname(__FILE__).'/../config.php';
require_once _SMARTY_PATH . '/Smarty.class.php';

// Защита контроллера
include _ROOT_PATH.'/app/security/check.php';

use Smarty\Smarty;
$smarty = new Smarty();
$smarty->setTemplateDir(_ROOT_PATH . '/templates');
$smarty->setCompileDir(_ROOT_PATH . '/templates_c');
$smarty->setCacheDir(_ROOT_PATH . '/cache');

// Инициализация переменных
$amount = null;
$years = null;
$interest = null;
$result = null;
$messages = [];

// Проверка сессии и получение роли
global $role;

// Получение параметров
function getParams(&$amount, &$years, &$interest){
    $amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
    $years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
    $interest = isset($_REQUEST['interest']) ? $_REQUEST['interest'] : null;    
}

// Валидация параметров
function validate(&$amount, &$years, &$interest, &$messages){
    if (!(isset($amount) && isset($years) && isset($interest))) {
        return false;
    }

    if ($amount == "") {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($years == "") {
        $messages[] = 'Nie podano okresu kredytowania';
    }
    if ($interest == "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    if (!empty($messages)) return false;

    if (!is_numeric($amount)) {
        $messages[] = 'Kwota kredytu nie jest liczbą';
    }
    if (!is_numeric($years)) {
        $messages[] = 'Okres kredytowania nie jest liczbą';
    }
    if (!is_numeric($interest)) {
        $messages[] = 'Oprocentowanie nie jest liczbą';
    }

    if (is_numeric($amount) && $amount <= 0) {
        $messages[] = 'Kwota kredytu musi być większa od 0';
    }
    if (is_numeric($years) && $years <= 0) {
        $messages[] = 'Okres kredytowania musi być większy od 0';
    }
    if (is_numeric($interest) && $interest < 0) {
        $messages[] = 'Oprocentowanie nie może być ujemne';
    }

    global $role;
    if ($role === 'user') {
        if (is_numeric($amount) && $amount > 100000) {
            $messages[] = 'Kwota kredytu dla użytkownika nie może przekraczać 100 000 PLN';
        }
        if (is_numeric($amount) && $amount < 1000) {
            $messages[] = 'Kwota kredytu dla użytkownika nie może być mniejsza niż 1 000 PLN';
        }
        if (is_numeric($years) && $years > 10) {
            $messages[] = 'Okres kredytowania dla użytkownika nie może przekraczać 10 lat';
        }
        if (is_numeric($interest) && $interest < 10) {
            $messages[] = 'Oprocentowanie dla użytkownika nie może być mniejsze niż 10%';
        }
    }

    return empty($messages);
}

// Обработка и расчет
function process(&$amount, &$years, &$interest, &$messages, &$result){
    $amount = floatval($amount);
    $years = intval($years);
    $interest = floatval($interest);

    $monthlyRate = $interest / 100 / 12;
    $months = $years * 12;

    if ($monthlyRate > 0) {
        $result = ($monthlyRate * $amount) / (1 - pow(1 + $monthlyRate, -$months));
    } else {
        $result = $amount / $months;
    }

    $result = round($result, 2);
}

// Основная логика
getParams($amount, $years, $interest);
if (validate($amount, $years, $interest, $messages)) {
    process($amount, $years, $interest, $messages, $result);
}

// Передача данных в Smarty
$smarty->assign('amount', $amount);
$smarty->assign('years', $years);
$smarty->assign('interest', $interest);
$smarty->assign('result', $result);
$smarty->assign('messages', $messages);
$smarty->assign('role', $role);

$smarty->display('calc.tpl');
?>