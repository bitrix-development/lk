<?php
// Защита от CSRF, защита сессии, шифрование и т.п.
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /pages/login.php');
    exit();
}

// Можно добавить защиту от CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Некорректный CSRF-токен');
    }
}
?>