<?php
include('database.php');

$mysqli = require __DIR__ . "/database.php";

if(isset($_SESSION['user_id'])){

    

    $user_id = $_SESSION['user_id']['user_id'];

    $query = "SELECT * FROM wishlist WHERE wishlist.user_id = $user_id" ;

    // Execute the statement
    if ($result = $mysqli->query($query)) {

        $listings = array();
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $listings[] = $row;
            
        }

        
        /* free result set */
        $result->free();
    }

    // Close the connection
    $mysqli->close();


}


?>
