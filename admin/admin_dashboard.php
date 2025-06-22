<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav id="navbar">
    <img src="../images/mismar-logo.png" alt="" class="logo">
    <ul id="menu-links">
        <a href="index.php"><li>Home</li></a>
        <a href="admin_dashboard.php"><li class="active">Dashboard</li></a>
        <a href="consultations.php"><li>Consultations</li></a>
    </ul>
</nav>

<div class="contact-wrapper">
    <h2>Admin: Add Project/Service</h2>
    <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" rows="5" required></textarea>

        <label>Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <label>PDF (optional):</label>
        <input type="file" name="pdf" accept="application/pdf">

        <label>Type:</label>
        <select name="type">
            <option value="project">Project</option>
            <option value="service">Service</option>
        </select>

        <button type="submit" id="b1">Upload</button>
    </form>
</div>
</body>
</html>
