<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services</title>

  
  <link rel="stylesheet" href="style.css">
  
</head>

<body>

  <nav id="navbar">
    <img src="../images/mismar-logo.png" alt="" class="logo">

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

   

    <img src="../images/menu.png" alt="" class="menu-icon" onclick="toggleMenu()">

  </nav>
  
  </div>
<?php
$host = "localhost";
$user = "root";
$pass = "MOhannad_9";
$dbname = "arch_db"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM services ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
  <div class="services-container">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="service-card">
        <div class="service-image-container">
          <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="service-image">
        </div>
        <div class="service-content">
          <h3><?php echo htmlspecialchars($row['title']); ?></h3>
          <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <p style="padding: 20px 10%;">No services found.</p>
<?php endif;

$conn->close();
?>
    
</div>


  <script src="script.js"></script>
</body>

</html>