<?php
// Start session
session_start();

// CSRF token validation function
function validate_csrf_token($token) {
    if (isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token']) {
        unset($_SESSION['csrf_token']);
        return true;
    }
    return false;
}

// Generate CSRF token function
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Initialize variables
$username = "";
$email = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'classass');

// Register user
if (isset($_POST['reg_user']) && validate_csrf_token($_POST['csrf_token'])) {
    // Get the form inputs
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Form validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // Register user if there are no errors
    if (count($errors) == 0) {
        $password = md5($password_1); // Encrypt the password before saving in the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        mysqli_query($db, $query);

        // Store the logged-in user's information in session variables
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";

        // Redirect to the protected page
        header('Location: studentDetails.php');
        exit();
    }
}
