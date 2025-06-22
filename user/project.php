<?php
$conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");
if ($conn->connect_error) die("DB connection error");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Projects</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <nav id="navbar">
    <img src="../images/mismar-logo.png" alt="Logo" class="logo">
    <ul id="menu-links">
      <a href="index.php"><li>Home</li></a>
      <a href="services.php"><li>Services</li></a>
      <a href="project.php"><li>Projects</li></a>
      <li><a href="contactUS.html">Contact Us</li></a>
     <li class="dropdown">
  <a href="#" class="dropbtn">Account ▾</a>
  <div class="dropdown-content">
    <a href="profile.php">Profile</a>
    <a href="../logout.php">Logout</a>
  </div>
</li>
    </ul>
    <img src="../images/menu.png" alt="Menu" class="menu-icon" onclick="toggleMenu()">
  </nav>

  <div class="projects-container">
    <?php
    $sql = "SELECT * FROM projects ORDER BY created_at DESC";
    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
      echo '
        <div class="project-card" data-pdf="../' . htmlspecialchars($row["pdf_path"]) . '">
          <div class="project-preview">
            <img src="../' . htmlspecialchars($row["image_path"]) . '" alt="Project Thumbnail">
          </div>
          <div class="project-content">
            <h3>' . htmlspecialchars($row["title"]) . '</h3>
            <p>' . nl2br(htmlspecialchars($row["description"])) . '</p>
          </div>
        </div>';
    }

    $conn->close();
    ?>
  </div>

  <!-- PDF Modal -->
  <div class="pdf-modal" style="display: none">
    <div class="pdf-modal-content">
      <span class="close-pdf">&times;</span>
      <div class="pdf-controls">
        <button class="prev-page">Previous</button>
        <span class="page-info">Page: <span id="current-page">1</span>/<span id="total-pages">1</span></span>
        <button class="next-page">Next</button>
      </div>
      <canvas id="pdf-canvas"></canvas>
    </div>
  </div>

  <!-- PDF.js and your script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
  <script>
    pdfjsLib.GlobalWorkerOptions.workerSrc =
      'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
  </script>
  <script src="./script.js"></script>
</body>
</html>
