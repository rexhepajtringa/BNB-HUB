<?php 

// Start the session
session_start();

// Retrieve the current session user ID
$user_id = $_SESSION['user_id'] ;


if(isset($_SESSION['user_id'])){
    $session_set = true;
    $host_id = $_SESSION['user_id']['user_id'];
}
else{
    $session_set = false;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bnbhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$propertyName = $_POST['propertyName'];
$city = $_POST['city'];
$country = $_POST['country'];
$address = $_POST['address'];
$summary = $_POST['summary'];
$accomodates = $_POST['accomodates'];
$surface = $_POST['surface'];
$bathrooms = $_POST['bathrooms'];
$bedrooms = $_POST['bedrooms'];
$beds = $_POST['beds'];
$has_tv_value = 0;
$has_heating_value = 0;
$has_internet_value = 0;
$has_ac_value = 0;
$has_kitchen_value = 0;
$pets_allowed = $_POST['pets_allowed'];
$price = $_POST['price'];
$host_id = $_SESSION['user_id']['user_id'];



if(isset($_POST['has_tv'])){
    $has_tv_value = 1;
    }
    if(isset($_POST['has_internet'])){
    $has_internet_value = 1;
    }
    if(isset($_POST['has_heating'])){
    $has_heating_value = 1;
    }
    if(isset($_POST['has_ac'])){

        $has_ac_value = 1;
 }
 if(isset($_POST['has_kitchen'])){
  $has_kitchen_value = 1;      }

  $stmt = $conn->prepare("INSERT INTO listing (propertyName, city, country, address, summary, accomodates, surface, bathrooms, bedrooms, beds, has_tv, has_heating, has_internet, has_ac, has_kitchen, pets_allowed, price, user_id)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssiiiiiiiiiisii", $propertyName, $city, $country,
        $address, $summary,$accomodates,$surface,$bathrooms,
        $bedrooms,$beds,$has_tv_value, $has_heating_value,
        $has_internet_value,$has_ac_value, $has_kitchen_value, $pets_allowed,$price, $host_id);


      

        $stmt->execute();
  
$conn->close();



?>