<?php

include('database.php');

$mysqli = require __DIR__ . "/database.php";

$query = "SELECT * FROM listing WHERE listing.listing_id = " .$_SESSION['listing_id'];

$result = $mysqli->query($query);

$listings = $result->fetch_assoc();

$_SESSION['listing_info'] = $listings;

/* free result set */
$result->free();


// Close the connection
$mysqli->close();
?>

