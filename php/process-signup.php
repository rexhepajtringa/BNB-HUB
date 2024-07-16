<?php

session_start();

// Sanitize input
$first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
$last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST["phone_number"], FILTER_SANITIZE_STRING);
// $password_confirmation = filter_var($_POST["password_confirmation"], FILTER_SANITIZE_STRING);

// Validate input
// if (empty($first_name)) {
//     die("Name is required");
// }

// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     die("Valid email is required");
// }

// if (strlen($password) < 8) {
//     die("Password must be at least 8 characters");
// }

// if ($password !== $password_confirmation) {
//     die("Passwords must match");
// }

// Use a library like zxcvbn to check password strength
// require_once "zxcvbn.php";
// $password_strength = zxcvbn($password);
// if ($password_strength['score'] < 2) {
//     die("Password is not strong enough");
// }

// Hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// check if email already exists in the database
$mysqli = require __DIR__ . "/database.php";
$query = "SELECT * FROM user WHERE email = ?";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($query)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    //email already exists in the database
    $_SESSION['email_alert'] = '1';
    header("Location: Sign-Up.php");
} else {
    //email is available
    //continue with the sign-up process
    $query = "INSERT INTO user (first_name, last_name, email, password, phone_number) VALUES (?, ?, ?, ?, ?)";
    if (!$stmt->prepare($query)) {
        die("SQL error: " . $conn->error);
    }
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $password_hash, $phone);
    if ($stmt->execute()) {
        header("Location: Sign-Up.php");
        $_SESSION['signed_up'] = '1';
        exit;
    } else {
        die($conn->error . " " . $conn->errno);
    }
}

$mysqli->close();
