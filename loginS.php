<?php
session_start();

$host = 'localhost';
$db   = 'arch_db';
$user = 'root';
$pass = 'MOhannad_9';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // assuming column is 'role'

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header('Location: admin/index.php');
        } else {
            header('Location: user/index.php');
        }
        exit();
    } else {
        header('Location: login.php?msg=failed');
        exit();
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
