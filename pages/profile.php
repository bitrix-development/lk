<?php
// User Profile and Password Change Page

// Include database connection
include 'db_connection.php';

// Start session
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Handle form submission for password change
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $update_query = "UPDATE users SET password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param('si', $new_password, $user_id);
    $update_stmt->execute();
    echo 'Password changed successfully!';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <p>Name: <?php echo htmlspecialchars($user['name']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

    <h2>Change Password</h2>
    <form method="POST" action="">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit" name="change_password">Change Password</button>
    </form>
</body>
</html>