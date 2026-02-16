<?php
include_once 'config.php'; // добавьте путь к файлу config.php, если он в другом месте
try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    // Выполняем команду установки кодировки
    $pdo->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>