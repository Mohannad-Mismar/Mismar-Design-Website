<?php
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
    $confirm_password = $_POST['confirm_password'];
    
    // Server-side password validation
    if ($password !== $confirm_password) {
        header('Location: index.html?error=password_mismatch');
        exit();
    }
    
    // Check if email exists
    $stmt = $pdo->prepare('SELECT email FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        header('Location: index.html?error=email_exists');
        exit();
    }
    
    // Hash password and insert
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
    $stmt->execute([$email, $hash]);
    
    header('Location: login.php');
    exit();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>