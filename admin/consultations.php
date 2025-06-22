<?php
$conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Consultations</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav id="navbar">
    <img src="../images/mismar-logo.png" class="logo">
    <ul id="menu-links">
      <a href="index.php"><li>Home</li></a>
      <a href="services.php"><li>Services</li></a>
      <a href="project.php"><li>Projects</li></a>
      <a href="consultations.php"><li>Consultations</li></a>
      <a href="../logout.php"><li>Logout</li></a>
    </ul>
    <img src="../images/menu.png" alt="" class="menu-icon" onclick="toggleMenu()">
  </nav>

  <div class="contact-wrapper">
    <h2>All Consultation Requests</h2>

    <?php
    $result = $conn->query("SELECT * FROM consultations ORDER BY created_at DESC");
    if ($result->num_rows > 0):
    ?>
    <div class="consultation-table-container">
      <div class="consultation-table-scroll">
      <table class="consultation-table">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Project Type</th>
          <th>Meeting</th>
          <th>Date</th>
          <th>Time</th>
          <th>Budget</th>
          <th>Description</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row["name"]) ?></td>
          <td><?= htmlspecialchars($row["email"]) ?></td>
          <td><?= htmlspecialchars($row["phone_number"]) ?></td>
          <td><?= htmlspecialchars($row["project_type"]) ?></td>
          <td><?= htmlspecialchars($row["meeting_format"]) ?></td>
          <td><?= htmlspecialchars($row["meeting_date"]) ?></td>
          <td><?= htmlspecialchars($row["meeting_time"]) ?></td>
          <td><?= htmlspecialchars($row["budget"]) ?></td>
          <td><?= nl2br(htmlspecialchars($row["description"])) ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
      </div>
      </div>
    <?php else: ?>
      <p>No consultations yet.</p>
    <?php endif; ?>

  </div>

  <script src="script.js"></script>
</body>
</html>
