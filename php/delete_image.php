<?php
    
    $conn = new mysqli("localhost", "root", "", "bnbhub");

    
    $fileName = $_POST['fileName'];

    
    $query = "DELETE FROM images WHERE image LIKE '%$fileName' ORDER BY image_id DESC LIMIT 1";;

    
    $result = $conn->query($query);

    
    if ($result) {
        
        unlink("uploads/$fileName");
        echo "Image deleted successfully";
    } else {
        echo "Error deleting image";
    }

    $conn->close();
?>
