<?php
include('database.php');

$mysqli = require __DIR__ . "/database.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Set the number of records per page
$records_per_page = 3;

// Calculate the offset
$offset = ($page - 1) * $records_per_page;
$query = "SELECT * FROM listing LIMIT $offset, $records_per_page";



// Execute the statement
if ($result = $mysqli->query($query)) {

    $listings = array();
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        $listings[] = $row;
    }
    $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);

    /* free result set */
    $result->free();
}

// Close the connection
$mysqli->close();
?>

