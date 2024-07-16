<?php

include("functions/functions.php");



if (isset($_SESSION['user_id'])) {
    $session_set = true;
    $clientName = $_SESSION['user_id']['first_name'];
    $profilepic = "50cbd008cf18137b71f8a02938fc4a7.jpg";
} else {
    $session_set = false;
    $clientName = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/lisiting_style.css">
    <title>BNBHUB</title>
</head>

<style>
body {
    background: url("images/living_room_for_the_admin.png") fixed;
    /* background-position: center; */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top;
    /* background-size: cover; */
}


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

@media screen and (max-width: 1024px) {
    .nav-links {
        width: 60%;
    }
}

@media only screen and (max-width: 767px) {


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
</style>

<body>

    <nav>
        <div class="logo">
            <img src="images/LOGO_USER.png">
            <h4>BNBHUB</h4>
        </div>

        <ul class="nav-links">
            <li class="link">
                <a href="admin.php">Home</a>
            </li>
            <li class="link">
                <a href="addPropertyAdmin.php">Add Property</a>
            </li>
            <li class="link">
                <a href="remove_users.php">Remove Account</a>
            </li>
            <li class="link">
                <a href="remove_property.php">Remove Property</a>
            </li>
            <li>
                <a href="#">
                    <div class="account">
                        <h4>Hi, Ana</h4>
                        <img src="images/person.jpg">
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



        <!-- random container -->
        <div class=" container" id="randomContainer">
            <?php
            $listings = getListings();
            if ($listings) {
                while ($listing = mysqli_fetch_assoc($listings)) {
                    $listing_id = $listing['listing_id'];
                    $listName = $listing['propertyName'];
                    $listCity = $listing['city'];
                    $listCountry = $listing['country'];
                    $listPrice = $listing['price'];
                    $images = array();
                    $images = displayImages($listing_id);
                    $images = mysqli_fetch_all($images, MYSQLI_ASSOC);
                    $remove =
                        '<form action="deleteProperty.php" method = "post">
                            <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                            <button type="submit" class="reserve_button">Delete</button>
                        </form>';
                    $property = '<form action="listing_session.php" method = "post">
                            <input type="hidden" name="listing_id" value="' .  $listing_id . '">
                            <span class="listing-buttons">
                            <button type="submit" class="reserve_button">Reserve</button>
                        </form>';

                    $html = '';
                    $dots = '';
                    if (!empty($images)) {
                        $counter = 1;
                        foreach ($images as $image) {
                            $dots .= '<span class="dot"></span>';
                            $counter++;
                        }
                    } else {
                        break;
                    }
                    if (!empty($images)) {
                        $counter = 1;
                        foreach ($images as $image) {
                            $html .= '<div class="mySlides fade">
                                <div class="numbertext">' . $counter . ' / ' . count($images) . '</div>
                                <img src="' . $image['image'] . ' " style="width:100%" />
                                <div class="text">Caption Text</div>
                                </div>';
                            $counter++;
                        }
                    } else {
                        break;
                    }

                    echo
                    '<div class="property-post">
                        <div class="slideshow-container">'
                        . $html .

                        '<a class="prev">&#10094;</a>
                    <a class="next">&#10095;</a>
            <div class="dots">'
                        . $dots . '
            </div>
        </div>
        <h2>' . $listName . '</h2>
        <p>' . $listCity . ',' . $listCountry . '</p>
        
        <br>
        <span class="listing-buttons">'
                        . $remove . '
                        
        </span>
    </div>
    ';
                }
            }
            ?>

        </div>
        <!-- end of random container -->


        <script src="js/app.js"></script>
</body>

</html>