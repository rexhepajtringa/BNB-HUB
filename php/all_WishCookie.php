<?php
session_start();
if(!isset($_SESSION['user_id'])){
    //redirect to login page or show an error message
}
else
{
    $user_id = $_SESSION['user_id']['user_id'];
    $id = strval($user_id);
    if(isset($_COOKIE[$id]))
    {
        $listings_json = $_COOKIE[$id];
        $listings = json_decode($listings_json, true);
        foreach ($listings as $listing) {
            echo "user_id: " . $listing['user_id'] . " listing_id: " . $listing['listing_id'] . "<br>";
        }
    }
    else{
        echo "Ska";
    }
}





?>