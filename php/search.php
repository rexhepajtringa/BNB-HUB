<?php


// Start the session

include("functions/functions.php");
// Retrieve the current session user ID
// $user_id = $_SESSION['user_id'] ;

if (isset($_SESSION['user_id'])) {
    $session_set = true;
    $clientName = $_SESSION['user_id']['first_name'];
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
    <link rel="stylesheet" href="style/lisiting_style.css">
    <title>BNBHUB</title>
</head>

<body onload="displaySort(1);">

    <nav>
        <div class=" logo">
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

        <!-- sorting buttons -->
        <div class="sorting_div">
            <button class="sorting_btn_design" id="random" onclick="displaySort(1);">Random</button>
            <button class="sorting_btn_design" id="decreasing" onclick="displaySort(2);">Decreasing</button>
            <button class=" sorting_btn_design" id="increasing" onclick="displaySort(3);">Increasing</button>
            <button class=" sorting_btn_design" id="pets_allowed" onclick="displaySort(4);">Pets Allowed</button>
            <button class=" sorting_btn_design" id="has_wifi" onclick="displaySort(5);">Has Wifi</button>
            <button class=" sorting_btn_design" id="has_ac" onclick="displaySort(6);">Has AC</button>
            <button class=" sorting_btn_design" id="has_tv" onclick="displaySort(7);">Has TV</button>
            <button class=" sorting_btn_design" id="has_heating" onclick="displaySort(8);">Has Heating</button>
            <button class=" sorting_btn_design" id="has_kitchen" onclick="displaySort(9);">Has Kitchen</button>
        </div>
        <br>

        <!-- random container -->
        <div class=" container" id="randomContainer">
            <?php
            $listings = filterListingsBySearch();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
        <h4>
            <h3>' . $listPrice . '$</h3> night
        </h4>
        <br>

        <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
    </div>
    ';
                }
            }
            ?>

        </div>
        <!-- end of random container -->

        <!-- decreasing container -->
        <div class="container" id="decreasingContainer">
            <?php
            $listings = filterListingsByNameDecreasing();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
        <h2>' . $listing_id . '' . $listName . '</h2>
        <p>' . $listCity . ',' . $listCountry . '</p>
        <h4>
            <h3>' . $listPrice . '$</h3> night
        </h4>
        <br>
        <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
    </div>
    ';
                }
            }
            ?>

        </div>
        <!-- end of decreasing container -->

        <!-- start of increasing container -->
        <div class="container" id="increasingContainer">
            <?php
            $listings = filterListingsByNameIncreasing();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
        <h2>' . $listing_id . '' . $listName . '</h2>
        <p>' . $listCity . ',' . $listCountry . '</p>
        <h4>
            <h3>' . $listPrice . '$</h3> night
        </h4>
        <br>

        <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
    </div>
    ';
                }
            }
            ?>

        </div>
        <!-- end of decreasing container -->

        <!-- start of petsAloowed container -->
        <div class="container" id="pets_allowedContainer">
            <?php
            $listings =  filterListingsByPetsAllowed();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
                    <h2>' . $listing_id . '' . $listName . '</h2>
                    <p>' . $listCity . ',' . $listCountry . '</p>
                    <h4>
                        <h3>' . $listPrice . '$</h3> night
                    </h4>
                    <br>

                    <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
                    </div>';
                }
            }
            ?>

        </div>
        <!-- end of petsAloowed container -->

        <!-- start of has wifi container -->
        <div class="container" id="has_wifiContainer">
            <?php
            $listings = filterListingsByHasWifi();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
                    <h2>' . $listing_id . '' . $listName . '</h2>
                    <p>' . $listCity . ',' . $listCountry . '</p>
                    <h4>
                        <h3>' . $listPrice . '$</h3> night
                    </h4>
                    <br>

                    <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
                    </div>';
                }
            }
            ?>

        </div>
        <!-- end of has wifi container -->

        <!-- start of has ac container -->
        <div class="container" id="has_acContainer">
            <?php
            $listings = filterListingsByHasAc();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
                    <h2>' . $listing_id . '' . $listName . '</h2>
                    <p>' . $listCity . ',' . $listCountry . '</p>
                    <h4>
                        <h3>' . $listPrice . '$</h3> night
                    </h4>
                    <br>

                    <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
                    </div>';
                }
            }
            ?>

        </div>
        <!-- end of has ac container -->

        <!-- start of tv container -->
        <div class="container" id="has_tvContainer">
            <?php
            $listings = filterListingsByHasTv();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
                    <h2>' . $listing_id . '' . $listName . '</h2>
                    <p>' . $listCity . ',' . $listCountry . '</p>
                    <h4>
                        <h3>' . $listPrice . '$</h3> night
                    </h4>
                    <br>

                    <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
                    </div>';
                }
            }
            ?>

        </div>
        <!-- end of tv container -->

        <!-- start of heating container -->
        <div class="container" id="has_heatingContainer">
            <?php
            $listings = filterListingsByHasHeating();
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
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
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
                    <h2>' . $listing_id . '' . $listName . '</h2>
                    <p>' . $listCity . ',' . $listCountry . '</p>
                    <h4>
                        <h3>' . $listPrice . '$</h3> night
                    </h4>
                    <br>

                    <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
                    </div>';
                }
            }
            ?>

        </div>
        <!-- end of heating container -->

        <!-- start of kitchen container -->
        <div class="container" id="has_kitchenContainer">
            <?php
            $listings = filterListingsByHasKitchen();
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
                    $html = '';
                    $dots = '';
                    $wishlist =
                        '<form action="wishlistConfirm.php" method = "post">
                        <input type="hidden" name="listing_id" value="'
                        .  $listing_id . '"> 
                        <button class="add_wishlist"><img src="icon/heart.png" alt="heart"></button>
                    </form>';
                    $property = '<form action="listing_session.php" method = "post">
                        <input type="hidden" name="listing_id" value="' .  $listing_id . '">
                        <span class="listing-buttons">
                        <button type="submit" class="reserve_button">Reserve</button>
                        </form>';
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
                    <h2>' . $listing_id . '' . $listName . '</h2>
                    <p>' . $listCity . ',' . $listCountry . '</p>
                    <h4>
                        <h3>' . $listPrice . '$</h3> night
                    </h4>
                    <br>

                    <span class="listing-buttons">'
                        . $property . $wishlist . '
                                        
                        </span>
                    </div>';
                }
            }
            ?>

        </div>
        <!-- end of kitchen container -->



    </div>
    <script>
    function displaySort(num) {
        switch (num) {
            case 1:
                random = document.getElementById('randomContainer');
                random.style.display = 'flex';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 2:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'flex';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 3:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'flex';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 4:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'flex';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 5:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'flex';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 6:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'flex';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 7:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'flex';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 8:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'flex';
                document.getElementById('has_kitchenContainer').style.display = 'none';
                break;
            case 9:
                random = document.getElementById('randomContainer');
                random.style.display = 'none';
                decreasing = document.getElementById('decreasingContainer');
                decreasing.style.display = 'none';
                increasing = document.getElementById('increasingContainer');
                increasing.style.display = 'none';
                pets_allowed = document.getElementById('pets_allowedContainer');
                pets_allowed.style.display = 'none';
                has_wifi = document.getElementById('has_wifiContainer');
                has_wifi.style.display = 'none';
                document.getElementById('has_acContainer').style.display = 'none';
                document.getElementById('has_tvContainer').style.display = 'none';
                document.getElementById('has_heatingContainer').style.display = 'none';
                document.getElementById('has_kitchenContainer').style.display = 'flex';
                break;

        }
    }
    </script>

    <script src="js/app.js"></script>
</body>

</html>