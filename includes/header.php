<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // подключение безопасности
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Личный кабинет руководителя</title>
<link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
<header>
  <h1>Личный кабинет руководителя отдела продаж</h1>
  <nav>
    <a href="/pages/dashboard.php">Главная</a>
    <a href="/pages/clients.php">Клиенты</a>
    <a href="/pages/orders.php">Заказы</a>
    <a href="/pages/profile.php">Профиль</a>
    <a href="/pages/logout.php">Выход</a>
  </nav>
</header>
<main>