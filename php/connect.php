<?php

// // Start the session
// session_start();

// // Retrieve the current session user ID
//  $user_id = $_SESSION['user_id'];

// if(isset($_POST['propertyName'])){
//     $propertyName = $_POST['propertyName'];
// }
// if(isset($_POST['country'])){
//     $country = $_POST['country'];
// }
// if(isset($_POST['city'])){
//     $city = $_POST['city'];
// }
// if(isset($_POST['address'])){
//     $address = $_POST['address'];
// }
// if(isset($_POST['summary'])){
//     $summary = $_POST['summary'];
// }
// if(isset($_POST['accomodates'])){
//     $accomodates = $_POST['accomodates'];
// }
// if(isset($_POST['surface'])){
//     $surface = $_POST['surface'];
// }
// if(isset($_POST['bedrooms'])){
//     $bedrooms = $_POST['bedrooms'];
// }
// if(isset($_POST['beds'])){
//     $beds = $_POST['beds'];
// }
// if(isset($_POST['bathrooms'])){
//     $bathrooms = $_POST['bathrooms'];
// }
// if(isset($_POST['petsAllowed'])){
//     $petsAllowed = $_POST['petsAllowed'];
// }
// if(isset($_POST['price'])){
//     $price = $_POST['price'];
// }

    
    
//     //Database connection

//     $conn = new mysqli('localhost', 'root','','test2');
//     if($conn->connect_error){

    
//      die('Connection Failed  : '.$conn->connect_error);
//     }
//     else
//     {



//         // $host_id = "SELECT * FROM user
//         // WHERE id = {$_SESSION["user_id"]}";
//         $has_tv_value = 0;
//         $has_internet_value = 0;
//         $has_heating_value=0;
//         $has_ac_value=0;
//         $has_kitchen_value=0;
//         if(isset($_POST['has_tv'])){
//         $has_tv_value = 1;
//         }
//         if(isset($_POST['has_internet'])){
//         $has_internet_value = 1;
//         }
//         if(isset($_POST['has_heating'])){
//         $has_heating_value = 1;
//         }
//         if(isset($_POST['has_ac'])){
//         $has_ac_value = 1;
//         }
//         if(isset($_POST['has_kitchen'])){
//         $has_kitchen_value = 1;
//         }



        // $stmt = $conn->prepare("insert into listing(propertyName, city,
        // country,address,summary,accomodates,surface,bathrooms,bedrooms,beds,has_tv, has_heating, 
        // has_internet, has_ac, has_kitchen,pets_allowed, price) 
        // values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        // $stmt->bind_param("sssssiiiiiiiiiisi", $propertyName, $city, $country,
        // $address, $summary,$accomodates,$surface,$bathrooms,
        // $bedrooms,$beds,$has_tv_value, $has_heating_value,
        // $has_internet_value,$has_ac_value, $has_kitchen_value, $petsAllowed,$price);

        /*Checkboxes*/

        $stmt->execute();
        echo "Property Added";
    //     if (isset($_FILES['file'])) {
    //         $upload_folder = 'uploads/';
    //         $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        
    //         foreach ($_FILES['file']['name'] as $key => $value) {
    //             $file_name = $_FILES['file']['name'][$key];
    //             $file_temp = $_FILES['file']['tmp_name'][$key];
        
    //             $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
    //             if (in_array($ext, $allowed_ext)) {
    //                 $path = $upload_folder . $file_name;
    //                 if (move_uploaded_file($file_temp, $path)) {
    //                     // insert the file path into the SQL table
    //                     $query = "INSERT INTO images (image) VALUES ('$path')";
    //                     $result = mysqli_query($conn, $query);
    //                 }
    //             }
    //         }
    //     }
    // }
        
        // echo "File(s) uploaded successfully.";
        // $stmt->close();
        // $conn->close();



        
?>