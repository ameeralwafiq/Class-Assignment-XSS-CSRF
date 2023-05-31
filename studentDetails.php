<?php
// Start session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit();
}

// Check if user is an admin (optional)
if ($_SESSION['username'] == 'admin') {
    // Redirect to admin page or display admin-specific content
    header('location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Details</title>
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'">
</head>
<body>
  <div class="header">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
  </div>
  
  <div class="content">
    <!-- Display student details or other protected content here -->
    <h3>Student Details:</h3>
    <!-- ... -->
  </div>
  
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
