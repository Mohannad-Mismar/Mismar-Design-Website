<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>projects</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <nav id="navbar">
    <img src="../images/mismar-logo.png" class="logo" />
    <ul id="menu-links">
      <a href="index.php"><li>Home</li></a>
      <a href="services.php"><li>Services</li></a>
      <a href="project.php"><li>Projects</li></a>
      <a href="consultations.php"><li>Consultations</li></a>
      <a href="../logout.php"><li>Logout</li></a>
    </ul>
  </nav>

  <!-- Add Project Button -->
  <div style="text-align: right; padding: 35px 10% 0px 10%;">
    <a href="add_project.html">
      <button id="add-service-btn">+ Add Project</button>
    </a>
  </div>

  <!-- Projects Section -->
  <?php
  $conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");
  if ($conn->connect_error) die("DB connection error");

  $sql = "SELECT * FROM projects ORDER BY created_at DESC";
  $res = $conn->query($sql);

  echo '<div class="projects-container">';
  while ($row = $res->fetch_assoc()) {
    echo '
      <div class="project-card" data-pdf="../' . htmlspecialchars($row["pdf_path"]) . '">
        <div class="project-preview">
          <img src="../' . htmlspecialchars($row["image_path"]) . '" alt="Project Thumbnail">
        </div>
        <div class="project-content">
          <h3>' . htmlspecialchars($row["title"]) . '</h3>
          <p>' . htmlspecialchars($row["description"]) . '</p>
          <form action="delete_project.php" method="POST" onsubmit="return confirm(\'Are you sure?\');">
            <input type="hidden" name="project_id" value="' . $row["id"] . '">
            <button type="submit" class="delete-btn">Delete</button>
          </form>
        </div>
      </div>';
  }
  echo '</div>';
  $conn->close();
  ?>

  <!-- PDF Viewer Modal -->
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

  <!-- PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
  <script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
  </script>

  <!-- Script -->
  <script src="script.js"></script>

</body>
</html>
