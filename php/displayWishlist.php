<?php 

session_start();


$listing_id = $_POST['listing_id'];

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id']['user_id'];
    $mysqli = require __DIR__ . "/database.php";

    // $cookie_name = "user";   
    // $cookie_value = $user_id;
    // $expire=time()+60*60*24*30;

    // setcookie($cookie_name, $cookie_value, $expire);

    $sql = "INSERT INTO wishlist (user_id,listing_id) VALUES ('$user_id','$listing_id')";
        $result = mysqli_query($mysqli,$sql);
        if ($result){
            header("Location: wishlist.php");
        }else {
            die ('The mistake is at:  <br>' . mysqli_error($mysqli));
        }




}


?> 