<?php
// Start session
session_start();

// Include server.php file
include('server.php');

// Check if the login form has been submitted
if (isset($_POST['login_user'])) {
    
    // Get the username and password from the login form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    // Validate username and password (e.g., check against a database record)
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    
    if (mysqli_num_rows($results) == 1) {
        // If the username and password are valid, store them in session variables
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        
        // Redirect to the protected page
        header('Location: studentDetails.php');
        exit();
    } 
    
    else {
        // If the username and password are not valid, display an error message
        array_push($errors, "Wrong username/password combination");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'">
</head>
<body>
  <div class="header">
    <h2>Login Page</h2>
  </div>

  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
</body>
</html>
