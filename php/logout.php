<?php

session_start();

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id']['user_id'];
    $mysqli = require __DIR__ . "/database.php";


    setcookie("wishlist", "", time() - 3600);
}
session_destroy();

header("Location: index.php");
exit;

?>