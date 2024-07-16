

    <?php
///////////////////////////////////////////////////////////
    include('database.php');
    
    $mysqli = require __DIR__ . "/database.php";
    
    $query = "SELECT * FROM user JOIN listing ON user.user_id = listing.user_id WHERE listing.user_id = ".$_SESSION['listing_info']['user_id'];

    
    
    $result = $mysqli->query($query);
    
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $_SESSION['owner_info'] = $rows;


    
    /* free result set */
    $result->free();
    
    
    // Close the connection
    $mysqli->close();
    ?>
    