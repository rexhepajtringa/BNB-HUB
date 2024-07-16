<?php 

session_start();

$listing_id = $_POST['listing_id'];


if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id']['user_id'];
    $id = strval($user_id);
    $mysqli = require __DIR__ . "/database.php";

    // $cookie_name = "wishlist";
    // $cookie_value = $user_id . '|' . $listing_id;
    // $expire=time()+60*60*24*30;

    // setcookie($cookie_name, $cookie_value, $expire);

    // $listings = array(
    //     array(
    //         'user_id' => 1,
    //         'listing_id' => 5
    //     ),
    //     array(
    //         'user_id' => 1,
    //         'listing_id' => 8
    //     )
    // );
    // $listings_json = json_encode($listings);
    // setcookie('wishlist', $listings_json, time() + (86400 * 30), "/");
   
    $new_listing = array('user_id' => $user_id, 'listing_id' => $listing_id);
    if(isset($_COOKIE[$id])){
        $listings_json = $_COOKIE[$id];
        $listings = json_decode($listings_json, true);
        echo "ooo";
    }else{
        $listings = array();
    }

    array_push($listings, $new_listing);

    if(!empty($listings)){
        $listings_json = json_encode($listings);
        setcookie($id, $listings_json, time() + (86400 * 30),"/");
        echo "mir";
    }
    else{
        echo "empty";
    }
}
    





