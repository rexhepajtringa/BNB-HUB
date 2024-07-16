<?php

session_start();
$listing_id = $_POST['listing_id'];


$_SESSION['listing_id'] = $listing_id;

header("Location: property.php");

?>