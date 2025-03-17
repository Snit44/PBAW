<?php
require_once dirname(__FILE__).'/../config.php';

//ochrona kontrolera
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$amount, &$years, &$interest){
    $amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
    $years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
    $interest = isset($_REQUEST['interest']) ? $_REQUEST['interest'] : null;    
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$amount, &$years, &$interest, &$messages){
    // sprawdzenie, czy parametry zostały przekazane
    if (!(isset($amount) && isset($years) && isset($interest))) {
        // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
        return false;
    }

    // sprawdzenie, czy potrzebne wartości zostały przekazane
    if ($amount == "") {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($years == "") {
        $messages[] = 'Nie podano okresu kredytowania';
    }
    if ($interest == "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    //nie ma sensu walidować dalej gdy brak parametrów
    if (count($messages) != 0) return false;

    // sprawdzenie, czy wartości są liczbami
    if (!is_numeric($amount)) {
        $messages[] = 'Kwota kredytu nie jest liczbą';
    }
    if (!is_numeric($years)) {
        $messages[] = 'Okres kredytowania nie jest liczbą';
    }
    if (!is_numeric($interest)) {
        $messages[] = 'Oprocentowanie nie jest liczbą';
    }

    // Dodatkowa walidacja logiczna
    if (is_numeric($amount) && $amount <= 0) {
        $messages[] = 'Kwota kredytu musi być większa od 0';
    }
    if (is_numeric($years) && $years <= 0) {
        $messages[] = 'Okres kredytowania musi być większy od 0';
    }
    if (is_numeric($interest) && $interest < 0) {
        $messages[] = 'Oprocentowanie nie może być ujemne';
    }

    // Ograniczenia dla użytkownika
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

    if (count($messages) != 0) return false;
    else return true;
}

function process(&$amount, &$years, &$interest, &$messages, &$result){
    global $role;

    // Konwersja parametrów
    $amount = floatval($amount); // Kwota jako liczba zmiennoprzecinkowa
    $years = intval($years);     // Lata jako liczba całkowita
    $interest = floatval($interest); // Oprocentowanie jako liczba zmiennoprzecinkowa

    // Obliczenie miesięcznej stopy procentowej i liczby rat
    $monthlyRate = $interest / 100 / 12; // Roczna stopa podzielona на 12 miesięcy
    $months = $years * 12;               // Liczba miesięcy

    // Formuła płatności miesięcznej (annuity formula): 
    // P = [r * PV] / [1 - (1 + r)^(-n)]
    if ($monthlyRate > 0) {
        $result = ($monthlyRate * $amount) / (1 - pow(1 + $monthlyRate, -$months));
    } else {
        $result = $amount / $months; // Jeśli oprocentowanie = 0, to prosty подział kwoty
    }

    // Zaokrąglenie wyniku do 2 мест после przecinka
    $result = round($result, 2);
}

//definicja zmiennych kontrolera
$amount = null;
$years = null;
$interest = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($amount, $years, $interest);
if (validate($amount, $years, $interest, $messages)) { // gdy brak błędów
    process($amount, $years, $interest, $messages, $result);
}

// Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';
?>