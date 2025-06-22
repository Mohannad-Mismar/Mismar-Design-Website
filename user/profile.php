<?php
session_start();

// Connect to the database directly
$conn = new mysqli("localhost", "root", "MOhannad_9", "arch_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// جبنا بيانات المستخدم
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('i', $userId);
$stmt->execute();
$userResult = $stmt->get_result()->fetch_assoc();

// جبنا استشارات المستخدم
$email = $userResult['email'];
$stmt2 = $conn->prepare("SELECT * FROM consultations WHERE email = ?");
$stmt2->bind_param('s', $email);
$stmt2->execute();
$consultations = $stmt2->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile - Mismar Design</title>
  <link rel="stylesheet" href="./style.css">
  <style>
    body {
      background-color: #f6f7fb;
      padding-top: 140px;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    
    .profile-container {
      max-width: 900px;
      margin: 0 auto 60px auto;
      padding: 45px 35px 38px 35px;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 32px 0 rgba(0,0,0,0.07);
      animation: popUp 0.7s cubic-bezier(.18,.89,.32,1.28);
    }
    @keyframes popUp {
      from { transform: translateY(40px); opacity: 0;}
      to { transform: translateY(0); opacity: 1;}
    }

    .profile-container h1 {
      text-align: left;
      font-size: 2.2rem;
      margin-bottom: 20px;
      font-weight: 700;
      color: #444;
    }
    .profile-info {
      margin-bottom: 32px;
      width: 100%;
    }
    .profile-info p {
      font-size: 1.08rem;
      margin-bottom: 7px;
      color: #555;
    }
    .profile-info strong {
      color: #1a1a1a;
      min-width: 130px;
      display: inline-block;
    }

    .consultations-title {
      font-size: 1.32rem;
      font-weight: bold;
      color: #444;
      margin-bottom: 12px;
      margin-top: 15px;
      border-bottom: 1.5px solid #e3e3e3;
      width: 100%;
      padding-bottom: 7px;
    }

    .consultation-table-container {
      width: 100%;
      overflow-x: auto;
      margin-top: 16px;
    }
    .consultation-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
      background: #fff;
    }
    .consultation-table thead {
      background: #f3f3f3;
    }
    .consultation-table th,
    .consultation-table td {
      padding: 10px 7px;
      border: 1px solid #ececec;
      text-align: left;
      vertical-align: top;
    }
    .consultation-table th {
      font-weight: bold;
      color: #333;
    }
    .consultation-table tr:nth-child(even) {
      background: #fafbfc;
    }
    .consultation-table a {
      color: #1976d2;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav id="navbar">
    <img src="../images/mismar-logo.png" alt="Mismar Logo" class="logo" />
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
  </nav>

  <!-- Profile Content -->
  <div class="profile-container">
    <h1>Your Profile</h1>
    <div class="profile-info">
      <p><strong>Email:</strong> <?php echo htmlspecialchars($userResult['email']); ?></p>
    </div>

    <div class="consultations-title">Your Consultation History</div>
    <div class="consultation-table-container">
      <table class="consultation-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Project Type</th>
            <th>Description</th>
            <th>Meeting Date</th>
            <th>Time</th>
            <th>Format</th>
            <th>Budget</th>
            <th>File</th>
            <th>Submitted At</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $consultations->fetch_assoc()) { ?>
            <tr>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
              <td><?php echo htmlspecialchars($row['project_type']); ?></td>
              <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
              <td><?php echo htmlspecialchars($row['meeting_date']); ?></td>
              <td><?php echo htmlspecialchars($row['meeting_time']); ?></td>
              <td><?php echo htmlspecialchars($row['meeting_format']); ?></td>
              <td><?php echo htmlspecialchars($row['budget']); ?></td>
              <td>
                <?php if(!empty($row['file_path'])) { ?>
                  <a href="../<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank">View</a>
                <?php } else { echo "-"; } ?>
              </td>
              <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
