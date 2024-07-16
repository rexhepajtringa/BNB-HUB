<?php
session_start();
include('database.php');

// $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
// $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
// $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

$user_id = $_POST['user_id'];
// $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
// $phone = filter_var($_POST["phone_number"], FILTER_SANITIZE_STRING);
// $profile_pic = filter_var($_POST["profile_pic"], FILTER_SANITIZE_STRING);

$mysqli = require __DIR__ . "/database.php";
// Prepare the delete statement
$stmt = $mysqli->prepare("DELETE user, listing, images FROM user 
                           JOIN listing ON user.user_id = listing.user_id
                           JOIN images ON listing.listing_id = images.listing_id
                           WHERE user.user_id = ?");
// Bind the user's ID to the statement
$stmt->bind_param("i", $user_id);
// Execute the statement
$stmt->execute();

$stmt = $mysqli->prepare("DELETE FROM user WHERE user_id = ?");
// Bind the user's ID to the statement
$stmt->bind_param("i", $user_id);
// Execute the statement
$stmt->execute();

if ($stmt->execute()) {
    header("Location: remove_users.php");
} else {
    echo "Error: " . $stmt->error;
    $stmt->close();
    $mysqli->close();
}