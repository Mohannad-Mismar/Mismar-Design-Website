<?php
$conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['project_id'])) {
  $id = intval($_POST['project_id']);

  // delete files first
  $get = $conn->query("SELECT image_path, pdf_path FROM projects WHERE id = $id");
  if ($row = $get->fetch_assoc()) {
    if (file_exists($row['image_path'])) unlink($row['image_path']);
    if (file_exists($row['pdf_path'])) unlink($row['pdf_path']);
  }

  $conn->query("DELETE FROM projects WHERE id = $id");
  header("Location: project.php");
}
$conn->close();
?>
