<?php

// Start the session
session_start();

// Retrieve the current session user ID
// $user_id = $_SESSION['user_id'] ;

if (isset($_SESSION['user_id'])) {
    $session_set = true;
    $clientName = $_SESSION['user_id']['first_name'];
    $profilepic = $_SESSION['user_id']['profile_pic'];
} else {
    $session_set = false;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet.css">
    <title>BNBHUB</title>
</head>
<style>
@font-face {
    font-family: primary;
    src: url(font/AirbnbCereal_W_Bd.otf);
}

@font-face {
    font-family: secondary;
    src: url(font/AirbnbCereal_W_Lt.otf);
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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: primary;
    scroll-behavior: smooth;
}

body {
    background: url("images/pexels-dada-design-12277293 1.png") fixed;
    /* background-position: center; */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top;
    /* background-size: cover; */
}

#boom {
    display: none;
}

/* !------------------------------//////
!---------------------------------//////
!-------------NAV BAR-------------//////
!---------------------------------//////
!---------------------------------//////
!---------------------------------/// */
nav {
    position: sticky;
    margin-top: 1rem;
    display: flex;
    justify-content: space-around;
    align-items: center;
    min-height: 8vh;
    color: var(--primary_light_two);
    font-size: 1.3rem;
    z-index: 100;
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
    width: 2rem;
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

/* !---------------------
!-------------------------
!--------------------------
!       NAv Bar End 
!--------------------------
!--------------------------
!---------------------------*/
</style>

<body background="images/pexels-dada-design-12277293 1.png">
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
                    <div class="account" id="boom">
                        <h4 id="loggedin">Hi <?php echo $clientName ?></h4>
                        <img src="<?php echo $profilepic ?>">
                    </div>
                </a>
            </li>
            <li>
                <div class="link pop">
                    <a href="Sign-Up.php">Log in</a>
                </div>

            </li>
            <li>

                <div class="link pop">
                    <a href="sign-up.php">Sign Up</a>
                </div>

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


    <h1 class="title">Book & Experience Amazing Places</h1>
    <div class="searchBox">
        <form action="search.php" method="GET">
            <input type="text" id="place" name="place" placeholder="Where to go?">
            <input type="date" id="start" name="check-in" placeholder="Check in">
            <input type="date" id="end" name="check-out" placeholder="Check out">
            <input type="number" id="guests" name="guests" placeholder="Guests" min="1">
            <input type="submit" id="search" value="SEARCH">
        </form>
    </div>
    <script>
    var session_set = <?php echo json_encode($session_set); ?>;

    if (session_set) {
        console.log("aaaaaajhb");
        let x = document.getElementsByClassName("pop");
        x[0].style.display = "none";
        x[1].style.display = "none";
        document.getElementById("boom").style.display = "flex";

    }

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
    </script>
    <?php unset($_SESSION['logged']); ?>
</body>

</html>