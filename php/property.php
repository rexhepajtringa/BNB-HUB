<?php


include("functions/functions.php");
include('database.php');
include("all_photos.php");
include('all_users.php');
include('listing_info.php');
include('owner.php');




foreach ($_SESSION['owner_info'] as $row) {
    $ownerName = $row['first_name'];
    $ownerLName = $row['last_name'];
    $profilepic = $row['profile_pic'];
    $phone = $row['phone_number'];
    $email = $row['email'];
    // Do something with the first name
}


if (isset($_SESSION['listing_info'])) {
    $propertyUser = $_SESSION['listing_info']['user_id'];
    $propertyName = $_SESSION['listing_info']['propertyName'];
    $city = $_SESSION['listing_info']['city'];
    $country = $_SESSION['listing_info']['country'];
    $summary = $_SESSION['listing_info']['summary'];
    $guest = $_SESSION['listing_info']['accomodates'];
    $surface = $_SESSION['listing_info']['surface'];
    $address = $_SESSION['listing_info']['address'];
    $bedroom = $_SESSION['listing_info']['bedrooms'];
    $bathroom = $_SESSION['listing_info']['bathrooms'];
    $bed = $_SESSION['listing_info']['beds'];
    $price = $_SESSION['listing_info']['price'];
    $hasTV = $_SESSION['listing_info']['has_tv'];
    $hasHeating = $_SESSION['listing_info']['has_heating'];
    $hasInternet = $_SESSION['listing_info']['has_internet'];
    $hasAC = $_SESSION['listing_info']['has_ac'];
    $hasKitchen = $_SESSION['listing_info']['has_kitchen'];
    $petsAllowed = $_SESSION['listing_info']['pets_allowed'];
}

if (isset($_SESSION['user_id']) && isset($_SESSION['listing_info'])) {
    $user_id = $_SESSION['user_id']['user_id'];
    $clientName = $_SESSION['user_id']['first_name'];
    $listing_id = $_SESSION['listing_info']['listing_id'];
    $cookie_name = $user_id . "_" . $listing_id;

    if (isset($_COOKIE[$cookie_name])) {
        $visits = (int)$_COOKIE[$cookie_name] + 1;
    } else {
        $visits = 1;
    }
    setcookie($cookie_name, $visits, time() + (86400 * 30));
    if ($visits == 3) {
        echo <<<"EOD"

    <div class="container">
    <div class = "popup open-popup"  id = "popup">
        <h2>Notification!</h2>
        <p>You have visted this property more than three times.<br>
        Do you want to add this property to your wishlist</p>
        <div class="popup-buttons">
        <form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="
    $listing_id"> 
            <button style = 'width = 100%;'>add to wish list</button>
        </form>
        <button onclick="closePopup()">close</button>
        </div>
    </div>
    </div>

    EOD;
    }
}
else{
    header("Location: index.php");
}

$reserve =
    '<form action="reserve.php" method = "post">
                        <div class="dates_input">
                        <div class="dates_input_text">
                            <div class="">check-in</div>
                            <div class="">check-out</div>
                        </div>
                            <br>
                            <div class="dates_input_dates">
                            <div class=""><input name="date1" type="date" id="date1"></div>
                            <div class=""><input name="date2" type="date" id="date2"></div>
                            </div>
                        </div>
                            <input type="hidden" name="listing_id" value="' .  $listing_id . '">
                            <span class="listing-buttons">
                            <button type="submit" class="reserve">Reserve</button>
                        </form>';

$wishlist =
    '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
    .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
                    </form>';

$maps = '<form action="geoposition.php" method = "post">
            <input type="hidden" name="country" value="' .  $country . '"> 
            <input type="hidden" name="city" value="' .  $city . '"> 
            <input type="hidden" name="address" value="' .  $address . '"> 
            <button class="add_wishlist">See Location ;)</button>
        </form>';
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @font-face {
        font-family: primary;
        src: url(font/AirbnbCereal_W_Bd.otf);
    }

    @font-face {
        font-family: secondary;
        src: url(font/AirbnbCereal_W_Lt.otf);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: primary;
        scroll-behavior: smooth;
    }

    body {
        background: url("images/pexels-dada-design-12277293\ 1.png") fixed;
        /* background-position: center; */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
        /* background-size: cover; */
    }


    :root {
        --primary_light_one: #e3e2df;
        --primary_light_two: #eae7dc;
        --primary_light_three: #dcd7c9;
        --secondary: #a27b5c;
        --secondary_hover: #7c5e44;
        --secondary_ani: #9e7777;
        --action_primary: #3f4e4f;
        --action_secondary: #2c3639;
    }

    /* ! scrollbar animation start*/
    ::-webkit-scrollbar {
        width: .8em;
    }

    ::-webkit-scrollbar-track {
        background-color: var(--primary_light_three);
        margin-block: 0.2em;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #9e7777;
        border-radius: 1vw;
        transition: .2s;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: var(--secondary_hover);
    }

    /*! scrollbar animation end*/


    nav {
        position: sticky;
        margin-top: 1rem;
        display: flex;
        justify-content: space-around;
        align-items: center;
        min-height: 8vh;
        color: var(--primary_light_two);
        font-size: 1.3rem;
        z-index: +100;
    }

    .logo {
        display: flex;
        justify-content: space-evenly;
        background-color: var(--secondary);
        border-radius: 15px;
        width: 9rem;
        height: 3rem;
    }

    .logo h4 {
        position: relative;
        top: .7rem;
    }

    .logo img {
        position: relative;
        height: 2rem;
        width: auto;
        top: .4rem;
    }

    .nav-links {
        display: flex;
        justify-content: space-around;
        width: 45%;
    }

    .nav-links li {
        list-style: none;
    }

    .nav-links .link {
        position: relative;
        top: .8rem;
    }

    .nav-links li a .account {
        display: flex;
        justify-content: space-evenly;
        background-color: var(--secondary);
        border-radius: 15px;
        width: 9rem;
        height: 3rem;
    }

    .nav-links li a .account img {
        position: relative;
        height: 2rem;
        width: auto;
        top: .4rem;
        border-radius: 50%;
    }

    .nav-links li a .account h4 {
        position: relative;
        top: .6rem;
        color: var(--primary_light_two);
    }

    .nav-links a {
        color: var(--secondary);
        text-decoration: none;
        letter-spacing: 1px;
        transition: .5s;
    }

    .nav-links a:hover {
        color: var(--secondary_hover);
        font-weight: bold;
    }

    .burger {
        display: none;
        cursor: pointer;
    }

    /* when we pres what size will it contain in the page and the transition */
    .burger div {
        width: 25px;
        height: 3px;
        background-color: var(--secondary_hover);
        margin: 5px;
        transition: all 00.3s ease;
    }

    .popup {
        width: 400px;
        background: #fff;
        border-radius: 6px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.1);
        padding: 0 30px 30px;
        color: #333;
        visibility: hidden;
        transition: transform 0.4s, top 0.4s;
    }

    .open-popup {
        position: fixed;
        z-index: 100;
        visibility: visible;
        top: 50%;
        transform: translate(-50%, -50%) scale(1);
    }

    .popup h2 {
        font-size: 38px;
        font-weight: 500;
        margin: 30px 0 10px;
    }

    .popup-buttons {
        width: 20rem;
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

    .popup-buttons button {
        width: 20rem;
        margin-bottom: 5px;
        padding: 10px 0;
        background: #6fd649;
        color: #fff;
        border: 0;
        outline: none;
        font-size: 18px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
    }

    .item4,
    .item3,
    .item,
    .table_row,
    .tables_info,
    .user_info,
    .big_container,
    .listing-summary,
    .user_image_name_rating {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .tables_info {
        margin-top: 70px;
    }

    .listing-summary {
        width: 100%;
        margin-top: 3em;
    }

    .big_container {
        width: 90%;
    }

    .smaller-container {
        margin-top: 20px;
        border-radius: 40px;
        width: 95%;
        display: grid;
        grid-template-columns: auto auto;
        gap: 10px;
        background-color: #EAE7DC;
        padding: 10px;
    }

    .glass {
        background: linear-gradient(129.89deg, rgba(255, 255, 255, 0.4) 13.17%, rgba(255, 255, 255, 0.1) 87.87%);
        box-shadow: 0px 4px 24px -1px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 40px;
    }

    .item1 {
        grid-row-start: 1;
        grid-row-end: 3;
        height: 635px;
        width: 635px;
        align-items: center;
        overflow-y: scroll;
    }

    .item2 {
        grid-column-start: 2;
        grid-column-end: 4;
        color: #A27B5C;
        border-bottom: 1px solid #A27B5C;
        padding-bottom: 15px;
    }

    .item3 {
        height: 100%;
        justify-content: flex-start;
        align-items: flex-start;
        color: #A27B5C;
    }

    .item4 {
        position: sticky;
        top: 3rem;
    }

    .item5,
    .item6,
    .item7 {
        grid-column-start: 1;
        grid-column-end: 4;
        border-bottom: 1px solid #A27B5C;
        width: 60%;
    }

    .user_info p:last-child {
        border-top: 1px solid #A27B5C;
        padding-top: 10px;
    }

    .images-container,
    .info-container {
        display: grid;
        grid-template-columns: auto auto;
    }

    .images_container {
        width: 100%;
    }

    .info-container {
        width: 85%;
        height: 200px;
        border: solid 3px black;
        border-radius: 10px;
    }

    .price,
    .guests {
        grid-column-start: 1;
        grid-column-end: 3;
    }

    .table_row {
        border-collapse: collapse;
        border: solid 1px black;
        color: #A27B5C;
        background-color: #EAE7DC;
        width: 98.9%;
    }

    .table_row:first-of-type,
    .table_row:last-child {
        border: none;
        font-size: 20px;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .table_row:first-of-type {
        border-radius: 10px 10px 0px 0px;
    }

    .table_row:last-child {
        border-radius: 0px 0px 10px 10px;
    }

    .property_image {
        width: 300px;
        height: 200px;
        margin: 5px;
    }

    .property_image:first-of-type {
        border-radius: 40px 0px 0px 0px;
    }

    .property_image:nth-child(2) {
        border-radius: 0px 40px 0px 0px;
    }



    .user_image {
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }

    .buttons {
        position: sticky;
        top: 10px;
        margin: 20px;
        flex-direction: row;
        width: 16rem;
    }

    .buttons button {
        /* margin-left: 10px;
        width: 150px;
        height: 50px;
        background: #2C3639;
        border-radius: 15px;
        color: #A27B5C;
        font-family: 'Inter';
        font-style: normal;
        font-weight: 700;
        font-size: 32px;
        line-height: 39px; */
        width: 7em;
        height: 4.5em;
        border-radius: 10px;
        border: none;
        background-color: var(--action_primary);
        color: var(--secondary);
        transition: .5s;
        cursor: pointer;

    }


    .add_wishlist img {
        width: 3.5rem;
        height: auto;
    }

    /* etnik code */
    .add_wishlist {
        width: 4.5em;
        height: 4.5em;
        border-radius: 10px;
        border: none;
        background-color: var(--action_primary);
        color: var(--secondary);
        transition: .5s;
        cursor: pointer;
    }

    /* etnik code */
    .description_of_property {
        grid-column-start: 1;
        grid-column-end: 3;
        font-size: 20px;
    }

    .user_info {
        flex-wrap: wrap;
        justify-content: flex-start;
        margin-top: 65px;
        align-items: flex-start;
    }

    .user_info p {
        margin-top: 1rem;
    }

    .smaller-container p,
    .smaller-containerh3 {
        margin-bottom: -5px;
        font-size: 20px;
    }

    .item7 p {
        display: inline;
        width: 70%;
    }

    .description_of_property p {
        display: inline;
        width: 50%;
    }

    .item7 .item {
        border-bottom: 1px solid #A27B5C;
    }

    .user_image_name_rating {
        width: 100%;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
    }

    .user_image_name {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        padding: 10px;
    }

    .user_image_name_rating h1 {
        margin-left: 30px;
    }

    .item {
        margin-top: 10px;
        padding: 20px;
        width: 100%;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .fa {
        color: #3F4E4F;
    }

    .checked {
        color: #A27B5C;
    }

    .rating {
        margin-left: 30px;
    }

    /* ---------------------------- */
    .myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 101;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    /* end of modal */

    /* Slideshow container */
    .slideshow-container {
        width: 100%;
        position: relative;
        margin: auto;
        display: none;
    }

    .mySlides img {
        width: 100%;
        height: 20rem;
        border-radius: 40px
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }



    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media screen and (max-width:1350px) {
        .item1 {
            grid-column-start: 2;
            grid-column-end: 4;
        }

        .item2 {
            grid-column-start: 1;
            grid-column-end: 3;
        }

        .item3 {
            grid-column-start: 1;
            grid-column-end: 3;
        }
    }

    @media screen and (max-width:1000px) {

        .item1 {
            grid-column-start: 1;
            grid-column-end: 4;
            width: 100%;
            height: 100%;
            overflow-y: visible;
        }

        .item2,
        .item3,
        .item5,
        .item6,
        .item7 {
            grid-column-start: 1;
            grid-column-end: 4;
        }

        .property_image {
            width: 200px;
            height: 150px;
        }

        .item5,
        .item6,
        .item7,
        .item7 .item {
            width: 100%;
        }

        .item4 {
            position: static;
        }

        .rating {
            margin-left: 0px;
        }

        .smaller-container {
            grid-template-columns: auto auto;
        }

        .user_image_name_rating {
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .images-container {
            display: none;
        }

        .slideshow-container {
            display: block;
        }

    }


    @media screen and (max-width: 1024px) {
        .nav-links {
            width: 60%;
        }


    }

    @media screen and (max-width: 767px) {


        body {
            overflow-x: hidden;
            /* ? so we won't se the side-nav-bar */
        }

        .nav-links {
            position: absolute;
            right: 0px;
            height: 92vh;
            top: 8vh;
            background-color: var(--primary_light_two), 0.5;
            backdrop-filter: blur(4px);
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 45%;
            transform: translateX(100%);
            /* ? to remove the side-nav-bar from the screen*/
            transition: transform 0.5s ease-in;

        }

        .nav-links li {
            opacity: 0;
            /* ? we won't se the content of the nav */
        }

        .burger {
            /* ? we will see only the three lines which will be click able to open the nav*/
            display: block;
            z-index: +1;
        }

        .nav-links li:hover .sub-menu-1 ul {
            display: none;
        }

        /* we use the property in js so it will be  displayed in the page when clicked*/
        .nav-active {
            transform: translateX(0%);
        }

        /* link fade for the pages being displayed */
        @keyframes navLinkFade {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0px);
            }
        }

        /* when we click the three lines will be transformed in button X */
        .toggle .line1 {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .toggle .line2 {
            opacity: 0;
        }

        .toggle .line3 {
            transform: rotate(45deg) translate(-5px, -6px);
        }
    }

    @media screen and (max-width: 450px) {

        .item1,
        .item2,
        .item4,
        .item5,
        .item6,
        .item7 {
            width: 80%;
        }

        .item7 p {
            width: 100%;
        }


    }

    /* etnik */
    .item4 {
        border: solid 2px var(--secondary);
        border-radius: 20px;
        padding-top: -30%;
        height: 24rem;

    }

    .dates_input {
        color: var(--secondary);
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .reserve-w-button {
        display: flex;
        flex-direction: column;
        width: 100rem;
        justify-content: space-around;
    }

    .reserve-w-button button {
        position: relative;
        margin-top: 1rem;
        width: 20rem;
        /* font-size: 25px; */
        font: primary;
        margin-top: 1rem;
    }

    .dates_input_text {
        text-transform: uppercase;
        font-family: primary;
        position: relative;
    }

    .tables_info {
        color: var(--secondary);
        margin-bottom: 5rem;
    }

    #date1,
    #date2 {
        color: var(--primary_light_three);
        background-color: var(--secondary);
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">

    </div>

    <nav>
        <div class="logo">
            <img src="images/LOGO_USER.png">
            <h4>BNBHUB</h4>
        </div>

        <ul class="nav-links">
            <li class="link">
                <a href="index.php">Home</a>
            </li>
            <li class="link">
                <a href="listing.php">Listing</a>
            </li>
            <li class="link">
                <a href="wishlist.php">Wishlist</a>
            </li>
            <li>
                <a href="profile.php">
                    <div class="account">
                        <h4>Hi,<?php echo $clientName ?></h4>
                        <img src="<?php echo $_SESSION['user_id']['profile_pic'] ?>">
                    </div>
                </a>
            </li>
        </ul>

        <!-- ? The Nav Bar-->
        <!-- ? Burger only on mobile mode-->
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>


    <div class="listing-summary">
        <div class="big_container glass">
            <div class="smaller-container">
                <div class="item1">
                    <div class="images-container">

                        <?php foreach ($images as $image) : ?>
                        <img class="property_image myImg" src="<?php echo $image['image'] ?>">

                        <?php endforeach; ?>
                    </div>

                    <div class="slideshow-container">
                        <?php foreach ($images as $image) : ?>
                        <div class="mySlides fade">
                            <img src="<?php echo $image['image'] ?>">
                        </div>
                        <?php endforeach; ?>

                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>

                    </div>

                </div>



                <div class="item2">
                    <span class="description_of_property">
                        <h3><?php echo $propertyName ?></h3>
                        <h3><?php echo $city ?>, <?php echo $country ?></h3><br>
                        <p>Description <br><?php echo $summary ?></p>
                    </span>
                </div>

                <div class="item3">
                    <span class="user_info">
                        <img class="user_image" src="<?php echo $profilepic ?>">
                        <p><?php echo $ownerName ?> <?php echo $ownerLName ?></p>
                        <p>Contact:</p>
                        <p><?php echo $phone ?></p>
                        <p><?php echo $email ?></p>
                        <p><?php echo $guest ?> guests· <?php echo $bedroom ?> bedrooms· <?php echo $bathroom ?>
                            bathrooms· <?php echo $bed ?> beds</p>
                    </span>
                </div>


                <div class="item4">

                    <span class="tables_info">


                        <p> <br>&nbsp; <strong><?php echo $price ?>$</strong> night</p>
                        <div class="table_row guests"> <br>
                            <strong>&nbsp; Guests <?php echo $guest ?></strong>
                        </div>


                        <span class="buttons">
                            <div class="reserve-w-button">
                                <?php
                                echo $reserve;
                                echo $wishlist;
                                echo $maps;
                                ?>
                            </div>

                        </span>
                </div>


                <div class="item5">

                    <span class="item">
                        <h1>Adress</h1>
                        <p><?php echo $address ?></p>
                    </span>



                </div>
                <div class="item6">

                    <span class="item">
                        <h1>More Info</h1>

                        <p>Has TV</p>
                    </span>


                </div>


                <div class="item7">
                    <h1>Reviews</h1>

                    <span class="item">
                        <div class="user_image_name_rating">
                            <span class="user_image_name">
                                <img class="user_image" src="images/image_6487327 (2).JPG">
                                <h1>Noent Berisha</h1>
                            </span>
                            <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>Description "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut
                            aliquip ex ea commodo consequat.</p>
                    </span>


                    <span class="item">

                        <div class="user_image_name_rating">
                            <span class="user_image_name">
                                <img class="user_image" src="images/image_6487327.JPG">
                                <h1>Gent Osmani</h1>
                            </span>
                            <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>Description "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut
                            aliquip ex ea commodo consequat.</p>
                    </span>

                    <span class="item">
                        <div class="user_image_name_rating">
                            <span class="user_image_name">
                                <img class="user_image" src="images/image_6487327 (1).JPG">
                                <h1>Etnik Ballata</h1>
                            </span>
                            <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>Description "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut
                            aliquip ex ea commodo consequat.</p>
                    </span>

                </div>



            </div>
        </div>
    </div>

    <script>
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementsByClassName("myImg");
    var modalImg = document.getElementById("img01");
    var span = document.getElementById("close");

    // When the user clicks on <span> (x), close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    for (var i = 0; i <= img.length; i++) {
        img[i].onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
    }

    const navSlide = () => {
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        const navLinks = document.querySelectorAll('.nav-links li');

        burger.addEventListener('click', () => {
            // ! Toggle nav
            nav.classList.toggle('nav-active');

            // ? Animate Links
            navLinks.forEach((link, index) => {
                if (link.style.animation) {
                    link.style.animation = ''
                } else {
                    link.style.animation =
                        `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`; //? the delay of the nav li to show up
                }
            });

            //?Burger Animation the three lines
            burger.classList.toggle('toggle');
        });

    }

    navSlide();

    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");

        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";

    }

    function openPopup() {
        popup.classList.add("open-popup");
    }

    function closePopup() {
        popup.classList.remove("open-popup");
    }
    </script>
</body>

</html>