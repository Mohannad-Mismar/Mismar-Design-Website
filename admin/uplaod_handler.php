<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access");
}

$conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$type = $_POST['type']; // 'project' or 'service'

$imagePath = null;
$pdfPath = null;

if (!empty($_FILES['image']['name'])) {
    $imageDir = 'uploads/images/';
    $imagePath = $imageDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}

if (!empty($_FILES['pdf']['name'])) {
    $pdfDir = 'uploads/pdfs/';
    $pdfPath = $pdfDir . basename($_FILES['pdf']['name']);
    move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath);
}

$stmt = $conn->prepare("INSERT INTO content_uploads (title, description, image_path, pdf_path, content_type) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $title, $description, $imagePath, $pdfPath, $type);

if ($stmt->execute()) {
    echo "<script>alert('Upload successful!'); window.location.href='admin_dashboard.php';</script>";
} else {
    echo "<script>alert('Upload failed.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
