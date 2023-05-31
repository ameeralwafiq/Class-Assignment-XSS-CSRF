<?php
// Start session
session_start();

// Initialize variables
$username = "";
$email = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// Register a new user
if (isset($_POST['reg_user'])) {
    // Sanitize user input
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    
    // Validate form fields
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    
    // Register the user if there are no errors
    if (count($errors) == 0) {
        // Encrypt the password before storing it in the database (e.g., using password_hash())
        $password = $password_1;
        
        // Insert user data into the database
        $query = "INSERT INTO users (username, email, password) 
                  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        
        // Store username in session and redirect to the protected page
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: studentDetails.php');
        exit();
    }
}

// Login user
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
    } else {
        // If the username and password are not valid, display an error message
        array_push($errors, "Wrong username/password combination");
    }
}

?>
