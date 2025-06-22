<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mismar Design</title>

  <!-- EXTERNAL CSS -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <<?php session_start(); ?>

<nav id="navbar">
  <img src="../images/mismar-logo.png" alt="" class="logo">
  <ul id="menu-links">
    <a href="index.php"><li>Home</li></a>
    <a href="services.php"><li>Services</li></a>
    <a href="project.php"><li>Projects</li></a>
<a href="consultations.php"><li>Consultations</li></a>
      <a href="../logout.php"><li>Logout</li></a>

    
  </ul>
  <img src="../images/menu.png" alt="" class="menu-icon" onclick="toggleMenu()">
  
</nav>

<div class="header">
  <div class="header-content">
    <h1>The Perfect Home Designed Just For You</h1>
    <p class="subtext">MISMAR Designs helps homeowners bring their custom home designs and renovations to life with our innovative 3D design home plans.</p>
    <img src="../images/sketch.png" alt="Home design example" class="content-image"id="style-preview">
     <div class="radio-group">
     <input type="radio" name="phototype" value="sketch" checked><label >Sketch</label>
     <input type="radio" name="phototype" value="render"><label>Render</label>

     </div>
      <p class="minitext">10+ Years of Designing Dream Homes</p>
  </div>
</div>
  
  </div>



  <script src="script.js"></script>
</body>
<?php
if (isset($_GET['success'])) {
  echo '<script>
    window.onload = function() {
      alert("Consultation request submitted! We\'ll contact you soon.");
    }
  </script>';
}
?>
</html>