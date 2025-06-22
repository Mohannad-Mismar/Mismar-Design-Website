<?php
$conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = $conn->real_escape_string($_POST["title"]);
  $description = $conn->real_escape_string($_POST["description"]);

  // Real server paths
  $targetImgDir = "../images/";
  $targetPdfDir = "../build/";

  $imgName = basename($_FILES["image"]["name"]);
  $pdfName = basename($_FILES["pdf"]["name"]);

  $imgPath = $targetImgDir . $imgName;
  $pdfPath = $targetPdfDir . $pdfName;

  // Paths stored in database (relative to root)
  $dbImgPath = "images/" . $imgName;
  $dbPdfPath = "build/" . $pdfName;

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $imgPath) &&
      move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdfPath)) {

    $sql = "INSERT INTO projects (title, description, image_path, pdf_path, created_at)
            VALUES ('$title', '$description', '$dbImgPath', '$dbPdfPath', NOW())";

    if ($conn->query($sql)) {
      echo "<script>alert('Project added'); window.location.href='project.php';</script>";
    } else {
      echo "DB Error: " . $conn->error;
    }
  } else {
    echo "File upload failed.";
  }
}

$conn->close();
?>
