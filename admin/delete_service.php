<?php
$host = "localhost";
$user = "root";
$pass = "MOhannad_9";
$dbname = "arch_db"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['service_id'])) {
  $id = intval($_POST['service_id']);

  // Optional: delete the image file first
  $imgQuery = "SELECT image_path FROM services WHERE id = $id";
  $result = $conn->query($imgQuery);
  if ($result && $row = $result->fetch_assoc()) {
    $imgPath = $row['image_path'];
    if (file_exists($imgPath)) {
      unlink($imgPath); // delete image file
    }
  }

  // Delete from DB
  $sql = "DELETE FROM services WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    header("Location: services.php");
    exit();
  } else {
    echo "Error deleting service: " . $conn->error;
  }
}

$conn->close();
?>
