<?php
// session_start();

    $mysqli = require __DIR__ . "/database.php";


    $query = "SELECT image FROM images WHERE images.listing_id = ".$_SESSION['listing_id'];

    // Execute the statement
    if ($result = $mysqli->query($query)) {

        $images = array();
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }

        /* free result set */
        $result->free();

    }

    // Close the connection
    $mysqli->close();