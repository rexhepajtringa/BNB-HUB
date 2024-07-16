<?php

$conn = new mysqli('localhost', 'root','', 'bnbhub') or die($conn->connect_error);

$query = "SELECT MAX(listing_id) FROM listing";
$result = mysqli_query($conn, $query);
$property_id = mysqli_fetch_array($result)[0];

if (isset($_FILES['file'])) {
    $upload_folder = 'uploads/';
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

    foreach ($_FILES['file']['name'] as $key => $value) {
        $file_name = $_FILES['file']['name'][$key];
        $file_temp = $_FILES['file']['tmp_name'][$key];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, $allowed_ext)) {
            $path = $upload_folder . $file_name;
            if (move_uploaded_file($file_temp, $path)) {
                // insert the file path into the SQL table
                // $query = "INSERT INTO images (image) VALUES ('$path')";
                // $result = mysqli_query($conn, $query);
                $tringa = $conn->prepare("INSERT INTO images (image, listing_id) VALUES (?, ?)");
                $tringa->bind_param("si", $path, $property_id);
                $tringa->execute();
                $tringa->close();
                

            }
        }
        
    }
}

