<?php
// ...

// Generate CSRF token and store it in session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validate CSRF token
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'];
}

// ...

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // ...

    if (count($errors) == 0) {
        // Validate CSRF token
        if (!validate_csrf_token($_POST['csrf_token'])) {
            die("CSRF token validation failed.");
        }

        // ...

        unset($_SESSION['csrf_token']); // Remove CSRF token after successful registration
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    // ...

    if (count($errors) == 0) {
        // Validate CSRF token
        if (!validate_csrf_token($_POST['csrf_token'])) {
            die("CSRF token validation failed.");
        }

        // ...
    }
}
?>

