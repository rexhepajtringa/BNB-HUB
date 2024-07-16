<?php

include("functions/functions.php");



if (isset($_SESSION['user_id'])) {
    $session_set = true;
    $clientId = $_SESSION['user_id']['user_id'];
    $clientName = $_SESSION['user_id']['first_name'];
    $clientPicture = $_SESSION['user_id']['profile_pic'];
    $profilepic = $_SESSION['user_id']['profile_pic'];
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
    <link rel="stylesheet" href="style/pwstyle.css">
    <script defer src="script.js"></script>

    <title>BNBHUB</title>

    <style>
    body {
        overflow-x: hidden;
    }

    #movable_button {
        z-index: 100;
    }

    .chat {
        display: flex;
        position: relative;
    }

    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: 200ms ease-in-out;
        border: 1px solid black;
        border-radius: 10px;
        z-index: 200;
        background-color: white;
        width: 40%;

    }

    .background {
        background-color: #1950ff;
        border-radius: 50%;
        box-shadow: 0 2.1px 1.3px rgba(0, 0, 0, 0.044),
            0 5.9px 4.2px rgba(0, 0, 0, 0.054), 0 12.6px 9.5px rgba(0, 0, 0, 0.061),
            0 25px 20px rgba(0, 0, 0, 0.1);
        height: 80px;
        left: 10px;
        position: absolute;
        top: 10px;
        width: 80px;
    }

    .chat-bubble {
        cursor: pointer;
        position: relative;
    }

    .bubble {
        transform-origin: 50%;
        transition: transform 500ms cubic-bezier(0.17, 0.61, 0.54, 0.9);
    }

    .line {
        fill: none;
        stroke: #ffffff;
        stroke-width: 2.75;
        stroke-linecap: round;
        transition: stroke-dashoffset 500ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    .line1 {
        stroke-dasharray: 60 90;
        stroke-dashoffset: -20;
    }

    .line2 {
        stroke-dasharray: 67 87;
        stroke-dashoffset: -18;
    }

    .circle {

        fill: #ffffff;
        stroke: none;
        transform-origin: 50%;
        transition: transform 500ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    .active1 .bubble {
        transform: translateX(24px) translateY(4px) rotate(45deg);
    }

    .active1 .line1 {
        stroke-dashoffset: 21;
    }

    .active1 .line2 {
        stroke-dashoffset: 30;
    }

    .active1 .circle {
        transform: scale(0);
    }

    .modal.active1 {
        transform: translate(-50%, -50%) scale(1);
    }

    .modal-header {
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid black;
    }

    .modal-header .title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .modal-header .close-button {
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .modal-body {
        padding: 10px 15px;
    }

    #overlay {
        position: fixed;
        opacity: 0;
        transition: 200ms ease-in-out;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, .5);
        pointer-events: none;
    }

    #overlay.active1 {
        opacity: 1;
        pointer-events: all;
    }

    .container1 {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        top: 90px;
        height: 100%;
        padding: 20px 100px;
        background-color: #123;
    }

    .container1:after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background-size: cover;
        z-index: -1;
        filter: blur(50px);
    }

    .contact-box {
        position: relative;
        top: 0px;
        max-width: 850px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-content: center;
        align-items: center;
        text-align: center;
        background-color: #fff;
        box-shadow: 0px 0px 19px 5px rgba(0, 0, 0, 0.19);
    }

    .left {
        height: 100%;
        background: url("dog.jpg") no-repeat center;
        background-size: cover;
    }

    .right {
        padding: 25px 40px;
    }

    h2 {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }



    h2:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        height: 4px;
        width: 50px;
        border-radius: 2px;
        background-color: #2ecc71;
    }

    .field {
        width: 95%;
        padding: 0.5rem 1rem;
        outline: none;
        border: 2px solid rgba(0, 0, 0, 0);
        background-color: rgba(230, 230, 230, 0.6);
        font-size: 1.1rem;
        margin-bottom: 22px;
        transition: .3s;
    }

    .field:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .field:focus {
        background-color: #fff;
        border: 2px solid rgba(30, 85, 250, 0.47);
    }

    .area {
        min-height: 150px;
    }

    /*the send button*/
    .btn {
        width: 100%;
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        background-color: #2ecc71;
        cursor: pointer;
        outline: none;
        border: none;
        color: #fff;
        transition: .3s;
    }

    .btn:hover {
        background-color: #27ae60;
    }
    </style>

</head>

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

    <div id="movable_button" class="chat custom-btn-container1" data-modal-target="#modal"
        ondblclick="this.classList.toggle('active1')">
        <div class="background"></div>
        <svg class="chat-bubble" width="100" height="100" viewBox="0 0 100 100">
            <g class="bubble">
                <path class="line line1" d="M 30.7873,85.113394 30.7873,46.556405 C 30.7873,41.101961
        36.826342,35.342 40.898074,35.342 H 59.113981 C 63.73287,35.342
        69.29995,40.103201 69.29995,46.784744" />
                <path class="line line2" d="M 13.461999,65.039335 H 58.028684 C
          63.483128,65.039335
          69.243089,59.000293 69.243089,54.928561 V 45.605853 C
          69.243089,40.986964 65.02087,35.419884 58.339327,35.419884" />
            </g>
            <circle class="circle circle1" r="1.9" cy="50.7" cx="42.5" />
            <circle class="circle circle2" cx="49.9" cy="50.7" r="1.9" />
            <circle class="circle circle3" r="1.9" cy="50.7" cx="57.3" />
        </svg>
    </div>

    <div class="modal" id="modal">

        <div class="contact-box">
            <div class="left"></div>
            <form class="right" action="send_feedback.php" method="POST">

                <h2>Contact Us</h2>

                <input type="text" class="field" placeholder="Your Name">

                <input type="email" name="email" class="field" placeholder="Your Email">


                <input type="subject" class="field area" name="subject" placeholder="Message">

                <button type="submit" class="btn">Send</button>

            </form>
        </div>
    </div>
    <div id="overlay"></div>

    <div class="listing-summary">



        <div class="container">
            <div class="title">
                <h1>YOUR PROPERTIES</h1>
            </div>
            <?php
            $hostListings = getHostProperties($clientId);
            if ($hostListings) {
                while ($hostListing = mysqli_fetch_assoc($hostListings)) {
                    $listing_id = $hostListing['listing_id'];
                    $listName = $hostListing['propertyName'];
                    $listCity = $hostListing['city'];
                    $listDesc = $hostListing['summary'];
                    $listCountry = $hostListing['country'];
                    $listPrice = $hostListing['price'];
                    $images = displayImages($listing_id);
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
                                        <button class="reserve_button">Remove</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>';
                }
            }

            ?>

            <div class="title">
                <h1>BOOKED</h1>
            </div>
            <?php
            $bookListings = getUserBookings($clientId);
            if ($bookListings) {
                while ($bookListing = mysqli_fetch_assoc($bookListings)) {
                    $listing_id = $bookListing['listing_id'];
                    $listName = $bookListing['propertyName'];
                    $listCity = $bookListing['city'];
                    $listDesc = $bookListing['summary'];
                    $listCountry = $bookListing['country'];
                    $listPrice = $bookListing['price'];
                    $images = displayImages($listing_id);
                    if ($images) {
                        $images = mysqli_fetch_all($images, MYSQLI_ASSOC);
                    } else {
                        echo "No images";
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
                        echo "No images";
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
                                <div>
                                    <span class="listing-buttons">
                                        <button class="reserve_button">Remove</button>
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
        <div class="editprofile">
            <a href="edit_user.php">edit profile</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous"></script>

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

    $('.chat').draggable();

    $('.chat').click(function() {
        $(this).toggleClass('active1');
    })

    var session_set = <?php echo json_encode($session_set); ?>;

    if (session_set) {
        console.log("aaaaaajhb");
        let x = document.getElementsByClassName("pop");
        x[0].style.display = "none";
        x[1].style.display = "none";
        document.getElementById("boom").style.display = "flex";

    }
    </script>



</body>

</html>