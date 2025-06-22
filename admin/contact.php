<?php
// Database credentials (replace with yours)
$servername = "localhost";
$username = "root";
$password = "MOhannad_9";
$dbname = "arch_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
$project_type = mysqli_real_escape_string($conn, $_POST['project_type']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$meeting_date = mysqli_real_escape_string($conn, $_POST['meeting_date']);
$meeting_time = mysqli_real_escape_string($conn, $_POST['meeting_time']);
$meeting_format = mysqli_real_escape_string($conn, $_POST['meeting_format']);
$budget = mysqli_real_escape_string($conn, $_POST['budget']);

// Handle file upload (optional)
$file_path = '';
if (!empty($_FILES['file']['name'])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $file_path = $target_file;
  }
}

// Insert into database
$sql = "INSERT INTO consultations (
  name, email, phone_number, project_type, description, 
  meeting_date, meeting_time, meeting_format, budget, file_path
) VALUES (
  '$name', '$email', '$phone', '$project_type', '$description',
  '$meeting_date', '$meeting_time', '$meeting_format', '$budget', '$file_path'
)";

// After successful database insertion
if ($conn->query($sql) === TRUE) {
  // Redirect to home page with success flag
  header("Location: index.php?success=1");
  exit();
} else {
  echo "Error: " . $conn->error;
}
$conn->close();
?>