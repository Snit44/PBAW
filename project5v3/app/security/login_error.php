<?php
session_start();
header('Content-Type: application/json');

$response = ['error' => false];

if (isset($_SESSION['login_error']) && $_SESSION['login_error'] !== "") {
    $response['error'] = true;
    $response['message'] = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

echo json_encode($response);
?>
