<?php

include("functions/functions.php");


if (isset($_SESSION['user_id'])) {
    $session_set = true;
    $clientId = $_SESSION['user_id']['user_id'];
    $clientName = $_SESSION['user_id']['first_name'];
    $clientPicture = $_SESSION['user_id']['profile_pic'];
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/pwstyle.css">
    <title>BNBHUB</title>
</head>

<style>
@font-face {
    font-family: primary;
    src: url(../font/AirbnbCereal_W_Bd.otf);
}

@font-face {
    font-family: secondary;
    src: url(../font/AirbnbCereal_W_Lt.otf);
}

/*! colors */
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

.reserve_wishlist {
    position: relative;
    background-color: var(--action_primary);
    color: var(--secondary);
    text-transform: uppercase;
    width: 14rem;
    height: 4rem;
    border-style: none;
    font-size: 25px;
    border-radius: 15px;
    bottom: 2rem;
}

@media only screen and (max-width: 1850px) {
    .reserve_wishlist {
        right: 8rem;

    }
}

@media only screen and (max-width: 1710px) {
    .reserve_wishlist {
        margin-right: 150%;
    }
}

@media only screen and (max-width: 810px) {
    .reserve_wishlist {
        margin-right: 40%;
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
                <a href="index.php">Home</a>
            </li>
            <li class="link">
                <a href="listing.php">Listing</a>
            </li>
            <li class="link">
                <a href="wishlist.php">Wishlist</a>
            </li>
            <li class="link">
                <a href="addPropertyUser.php">Become a Host</a>
            </li>
            <li>
                <a href="profile.php">
                    <div class="account">
                        <h4>Hi, <?php echo $clientName ?></h4>
                        <?php echo '<img src="' . $profilepic . '">'; ?>

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


        <div class="container">
            <div class="title">
                <h1>WISHLIST</h1>
            </div>
            <?php
            $hostListings = getUserWishlists($clientId);
            if ($hostListings) {
                while ($hostListing = mysqli_fetch_assoc($hostListings)) {
                    $listing_id = $hostListing['listing_id'];
                    $listName = $hostListing['propertyName'];
                    $listCity = $hostListing['city'];
                    $listDesc = $hostListing['summary'];
                    $listCountry = $hostListing['country'];
                    $listPrice = $hostListing['price'];
                    $images = displayImages($listing_id);
                    $property = '<form action="listing_session.php" method = "post">
                        <input type="hidden" name="listing_id" value="' .  $listing_id . '">
                        <span class="listing-buttons">
                        <button type="submit" class="reserve_wishlist" id="reserve_wishlist">Reserve</button>
                        </form>';
                    if ($images) {
                        $images = mysqli_fetch_all($images, MYSQLI_ASSOC);
                    } else {
                        break;
                    }
                    $html = '';
                    $dots = '';
                    if ($images) {
                        $counter = 1;
                        foreach ($images as $image) {
                            $dots .= '<span class="dot"></span>';
                            $counter++;
                        }
                    } else {
                        break;
                    }
                    if ($images) {
                        $counter = 1;
                        foreach ($images as $image) {
                            $html .= '<div class="mySlides fade">
                                <div class="numbertext">' . $counter . ' / ' . count($images) . '</div>
                                <img src="' . $image['image'] . ' " style="width:100%" />
                                <div class="text">Caption Text</div>
                                </div>';
                            $counter++;
                        }
                    }
                    echo '<div class="property-post">
                        <div class="allproperty">
                            <div class="left_part">
                                <div class="slideshow-container">
                                    ' . $html . '
                                    <a class="prev">&#10094;</a>
                                    <a class="next">&#10095;</a>
                                    <div class="dots">
                                        ' . $dots . '
                                    </div>
                                </div>
                            </div>
                            <div class="right_part">
                            <div class="right_head">
                                <h2>' . $listName . '</h2>
                                <p>' . $listCity . ', ' . $listCountry . '</p>
                                <p>' . $listDesc . '</p>
                            </div>
                            <div class="right_tail">
                                <div class="remove_prop">
                                    <span class="listing-buttons">
                                        ' . $property . '
                                    </span>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>';
                }
            }

            ?>
        </div>
    </div>

    <script>
    // ?nav bar animation
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


    (function() {

        init(); //on page load - show first slide, hidethe rest

        function init() {

            parents = document.getElementsByClassName('slideshow-container');

            for (j = 0; j < parents.length; j++) {
                var slides = parents[j].getElementsByClassName("mySlides");
                var dots = parents[j].getElementsByClassName("dot");
                slides[0].classList.add('active-slide');
                dots[0].classList.add('active');
            }
        }

        dots = document.getElementsByClassName('dot'); //dots functionality

        for (i = 0; i < dots.length; i++) {

            dots[i].onclick = function() {

                slides = this.parentNode.parentNode.getElementsByClassName("mySlides");

                for (j = 0; j < this.parentNode.children.length; j++) {
                    this.parentNode.children[j].classList.remove('active');
                    slides[j].classList.remove('active-slide');
                    if (this.parentNode.children[j] == this) {
                        index = j;
                    }
                }

                this.classList.add('active');
                slides[index].classList.add('active-slide');

            }
        }
        //prev/next functionality
        links = document.querySelectorAll('.slideshow-container a');

        for (i = 0; i < links.length; i++) {
            links[i].onclick = function() {
                current = this.parentNode;

                var slides = current.getElementsByClassName("mySlides");
                var dots = current.getElementsByClassName("dot");
                curr_slide = current.getElementsByClassName('active-slide')[0];
                curr_dot = current.getElementsByClassName('active')[0];
                curr_slide.classList.remove('active-slide');
                curr_dot.classList.remove('active');
                if (this.className == 'next') {

                    if (curr_slide.nextElementSibling.classList.contains('mySlides')) {
                        curr_slide.nextElementSibling.classList.add('active-slide');
                        curr_dot.nextElementSibling.classList.add('active');
                    } else {
                        slides[0].classList.add('active-slide');
                        dots[0].classList.add('active');
                    }

                }

                if (this.className == 'prev') {

                    if (curr_slide.previousElementSibling) {
                        curr_slide.previousElementSibling.classList.add('active-slide');
                        curr_dot.previousElementSibling.classList.add('active');
                    } else {
                        slides[slides.length - 1].classList.add('active-slide');
                        dots[slides.length - 1].classList.add('active');
                    }

                }

            }

        }
    })();
    </script>

</body>

</html>