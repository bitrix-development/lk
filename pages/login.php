<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../db.php';
// Получите всех пользователей
$stmt = $pdo->query("SELECT id, password FROM users");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    // Предположим, что текущий пароль — это MD5-хеш
    $md5_password = $user['password'];

    // Восстановим исходный пароль, если есть возможность
    // Но если у вас только MD5, то нужно знать оригинальный пароль или сбросить их
    // Обычно, если у вас только MD5, обновление невозможно без знания паролей
    // Поэтому лучше сбросить пароли и установить новые вручную или через интерфейс

    // Для примера: установить новый пароль для всех
    $new_password = 'password123'; // или любой другой
    $new_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Обновляем пароль
    $updateStmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
    $updateStmt->execute([':password' => $new_hash, ':id' => $user['id']]);
}

echo "Пароли обновлены.";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Защита от SQL-инъекций
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Неверные логин или пароль";
    }
}
?>

<?php include '../includes/header.php'; ?>

<h2>Вход в личный кабинет</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="">
    <label>Логин:</label>
    <input type="text" name="login" required />
    <label>Пароль:</label>
    <input type="password" name="password" required />
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>" />
    <button type="submit">Войти</button>
</form>

<?php include '../includes/footer.php'; ?>