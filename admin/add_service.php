<?php
$host = "localhost";
$user = "root";
$pass = "MOhannad_9";
$dbname = "arch_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $conn->real_escape_string($_POST["title"]);
  $description = $conn->real_escape_string($_POST["description"]);

  // Handle image upload
  $targetDir = "../images/";
  $imageName = basename($_FILES["image"]["name"]);
  $targetFile = $targetDir . $imageName;

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $imagePath = $targetFile;

    $sql = "INSERT INTO services (title, description, image_path, created_at)
            VALUES ('$title', '$description', '$imagePath', NOW())";

    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Service added successfully!'); window.location.href='services.php';</script>";
    } else {
      echo "Error: " . $conn->error;
    }
  } else {
    echo "Error uploading image.";
  }
}
$conn->close();
?>
