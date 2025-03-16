<?php
// KONTROLER kredytowego kalkulatora
require_once dirname(__FILE__).'/../config.php';
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: " . _APP_URL . "/index.php");
    exit();
}

// 1. Pobranie parametrów
$amount = $_REQUEST['amount']; // Kwota kredytu
$years = $_REQUEST['years'];   // Okres kredytowania w latach
$interest = $_REQUEST['interest']; // Oprocentowanie (roczne, w procentach)

// 2. Walidacja parametrów
$messages = []; // Tablica na komunikaty błędów

// Sprawdzenie, czy parametry zostały przekazane
if (!(isset($amount) && isset($years) && isset($interest))) {
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// Sprawdzenie, czy wartości nie są puste
if ($amount == "") {
    $messages[] = 'Nie podano kwoty kredytu';
}
if ($years == "") {
    $messages[] = 'Nie podano okresu kredytowania';
}
if ($interest == "") {
    $messages[] = 'Nie podano oprocentowania';
}

// Jeśli brak błędów, walidacja typów danych
if (empty($messages)) {
    // Sprawdzenie, czy wartości są liczbами
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

    //full blok
    // Ograniczenia dla usera
    $role = $_SESSION['role'];
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
}

// 3. Wykonanie obliczeń, jeśli brak błędów
if (empty($messages)) {
    // Konwersja parametrów
    $amount = floatval($amount); // Kwota jako liczba zmiennoprzecinkowa
    $years = intval($years);     // Lata jako liczba całkowita
    $interest = floatval($interest); // Oprocentowanie jako liczba zmiennoprzecinkowa

    // Obliczenie miesięcznej stopy procentowej i liczby rat
    $monthlyRate = $interest / 100 / 12; // Roczna stopa podzielona na 12 miesięcy
    $months = $years * 12;               // Liczba miesięcy

    // Formuła płatności miesięcznej (annuity formula): 
    // P = [r * PV] / [1 - (1 + r)^(-n)]
    if ($monthlyRate > 0) {
        $result = ($monthlyRate * $amount) / (1 - pow(1 + $monthlyRate, -$months));
    } else {
        $result = $amount / $months; // Jeśli oprocentowanie = 0, to prosty podział kwoty
    }

    // Zaokrąglenie wyniku do 2 miejsc po przecinku
    $result = round($result, 2);
}

// 4. Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';
?>