<?php

session_start();
global $mysqli;
connectionDB();
getListings();



function connectionDB()
{

    $host = "localhost";
    $dbname = "bnbhub";
    $username = "root";
    $password = "";

    $mysqli = new mysqli(
        hostname: $host,
        username: $username,
        password: $password,
        database: $dbname
    );

    if ($mysqli->connect_errno) {
        die("Connection error: " . $mysqli->connect_error);
    }

    return $mysqli;
}


// just gets all the listings by random sorted in the databases
function getListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;

    $sql = "SELECT listing_id, propertyName, city, country, price FROM listing LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}

// sort the properties in a increasing order for the price
function getIncreasingListings()
{
    global $mysqli;
    $mysqli = connectionDB();
    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;

    $sql = "SELECT listing_id, propertyName, city, country, price FROM listing ORDER BY price ASC LIMIT $offset, $records_per_page ";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}

// sort thge properties in a decreasing order for the price
function getDecreasingListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;

    $sql = "SELECT listing_id, propertyName, city, country, price FROM listing ORDER BY price DESC LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}

// selects only the properties that allow pets 
function getPetsAllowedListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;

    $sql = "SELECT listing_id, propertyName, city, country, price 
    FROM listing WHERE listing.pets_allowed = 'yes'
    LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found that has pets allowed";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}


// book the property if it is available
function bookProp($check_in, $check_out, $listing_id, $user_id)
{
    global $mysqli;
    $dates = array();
    $start_date = strtotime($check_in);
    $end_date = strtotime($check_out);
    for ($i = $start_date; $i <= $end_date; $i += 86400) {
        $dates[] = date('Y-m-d', $i);
    }

    $unavailable_dates = checkPAvailability($listing_id, $dates);
    if (count($unavailable_dates) > 0) {
        // if the car is not available in one of the selected dates
        $declined = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="style/lisiting_style.css">
                        <title>BNBHUB</title>
                    </head>
                    <body>
                    <div class="book_confirm">
                        <div>
                        <h1>Ooops?</h1>
                        <br>
                        <p>Sorry, someone has already booked that property.<br>
                        You can check other beautiful properties</p>
                        <a href="listing.php" class"go_back_booking">GO BACK</a>
                    </div>
                    </div>
                    </body>
                    </html>';
        echo $declined;
        //property is already booked
        die("" . implode(",", $unavailable_dates));
    } else {
        // Insert booking dates 
        foreach ($dates as $date) {
            $sql = "INSERT INTO bookings (user_id, listing_id, book_date) 
            VALUES ($user_id, $listing_id, '$date')";
            $result = mysqli_query($mysqli, $sql);
        }
        if ($result) {
            $confirmed = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="style/lisiting_style.css">
                        <title>BNBHUB</title>
                    </head>
                    <body>
                    <div class="book_confirm">
                        <div>
                        <h1>Confirmed!</h1>
                        <br>
                        <p>Have an enjoyable time during your vacation.</p>
                        <a href="listing.php" class"go_back_booking">GO BACK</a>
                    </div>
                    </div> 
                    
                    </body>
                    </html>';
            echo $confirmed;
            include('send_confirmation.php');
        } else {
            die('The mistake is at: <br>' . mysqli_error($mysqli));
        }
    }
}


// check if a property is available to be booked through those tables 
function checkPAvailability($listing_id, $dates)
{
    global $mysqli;
    // Create an array to store the unavailable dates
    $unavailable_dates = array();
    // Loop through the dates array to check each date
    foreach ($dates as $date) {
        $sql = "SELECT book_date FROM bookings WHERE listing_id = $listing_id AND book_date IN ('" . implode("','", $dates) . "')";
        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {
            // If a date is found in the loans_date table, add it to the unavailable_dates array
            $unavailable_dates[] = $date;
        }
    }
    // Return the unavailable dates array
    return $unavailable_dates;
}
// selects only the properties that have internet
function getHasWifiListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;
    $sql = "SELECT listing_id, propertyName, city, country, price 
    FROM listing WHERE listing.has_internet = 1
    LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            echo "No listing found that has internet";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}


// has ac filtering
function getHasACListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;
    $sql = "SELECT listing_id, propertyName, city, country, price 
    FROM listing WHERE listing.has_ac = 1 
    LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found that has AC";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}


//has tv
function getHasTVListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;
    $sql = "SELECT listing_id, propertyName, city, country, price 
    FROM listing WHERE listing.has_tv = 1
    LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found that has TV";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}


// has heating
function getHasHeatingListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;
    $sql = "SELECT listing_id, propertyName, city, country, price 
    FROM listing WHERE listing.has_heating = 1 
    LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found that has TV";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}


// has kitchen filter
function getHasKitchenListings()
{
    global $mysqli;
    $mysqli = connectionDB();

    global $page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Set the number of records per page
    $records_per_page = 3;

    // Calculate the offset
    $offset = ($page - 1) * $records_per_page;
    $sql = "SELECT listing_id, propertyName, city, country, price 
    FROM listing WHERE listing.has_kitchen = 1
    LIMIT $offset, $records_per_page";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            global $total_pages;
            $total_pages = ceil($mysqli->query("SELECT COUNT(*) as num_rows FROM listing")->fetch_object()->num_rows / $records_per_page);
            return $result;
        } else {
            echo "No listing found that has kitchen";
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}





// display images
function displayImages($listing_id)
{
    global $mysqli;
    $mysqli = connectionDB();
    $sql = 'SELECT * 
    FROM images AS i
    LEFT JOIN listing AS l ON i.listing_id = l.listing_id
    WHERE l.listing_id = ?';
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "i", $listing_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}


// ?add to wishlist
function add_wishlist()
{
    $listing_id = $_POST['listing_id'];

    if (isset($_SESSION['user_id'])) {

        $user_id = $_SESSION['user_id']['user_id'];
        $mysqli = require __DIR__ . "/database.php";

        $sql = "INSERT INTO wishlist (user_id,listing_id) VALUES ('$user_id','$listing_id')";
        $result = mysqli_query($mysqli, $sql);
        if ($result) {
            echo $alert_message;
        } else {
            // echo $declined;
            die('The mistake is at: <br>' . mysqli_error($mysqli));
        }
    } else {
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="style/lisiting_style.css">
                    <title>BNBHUB</title>
                </head>
                <body>
                <div class="book_confirm">
                    <div>
                    <h1>Ooops?</h1>
                    <br>
                    <p>You need to log in first</p>
                    <a href="login.php" class"go_back_booking">LOG IN</a>
                </div>
                </div>
                </body>
                </html>';
    }
}


// users booking 
function getUserBookings($clientId)
{
    global $mysqli;
    $mysqli = connectionDB();
    $sql = 'SELECT DISTINCT l.listing_id, l.propertyName, l.city, l.country, l.summary, l.price 
FROM bookings AS b
LEFT JOIN listing AS l ON b.listing_id = l.listing_id
LEFT JOIN user AS u ON b.user_id = u.user_id
WHERE b.user_id = ?';
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "i", $clientId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            echo '<div class="title">
                    <h6>No properties found by you!</h6>
                    <div class="editprofile">
                        <a href="listing.php">Book Now</a>
                    </div>
                </div>';
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}

// wishlist
function getUserWishlists($clientId)
{
    global $mysqli;
    $mysqli = connectionDB();
    $sql = 'SELECT DISTINCT l.listing_id, l.propertyName, l.city, l.country, l.summary, l.price 
FROM wishlist AS w
LEFT JOIN listing AS l ON w.listing_id = l.listing_id
LEFT JOIN user AS u ON w.user_id = u.user_id
WHERE w.user_id = ?';
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "i", $clientId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            echo '<div class="title">
                    <h6>No properties that you like <br> Whyyyyy?</h6>
                    <div class="editprofile">
                        <a href="listing.php">Book Now</a>
                    </div>
                </div>';
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}

// ? get host properties
function getHostProperties($clientId)
{
    global $mysqli;
    $mysqli = connectionDB();
    $sql = 'SELECT * 
    FROM listing as l
    LEFT JOIN user AS u ON u.user_id = l.user_id
    WHERE l.user_id = ?';
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "i", $clientId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            echo '<div class="title">
                    <h6>No properties found by you!</h6>
                </div>';
        }
    } else {
        die('Connection with database was not created for ' . mysqli_error($mysqli));
    }
}

function filterListingsBySearch()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            // Get the form data
            $query = $_GET["place"];
            $queryGN = $_GET["guests"];
            $queryCI = $_GET["check-in"];
            $queryCO = $_GET["check-out"];

            $stmt = $mysqli->prepare("SELECT * 
            FROM listing l 
            WHERE l.city LIKE ? 
            AND l.accomodates >= ? 
            AND l.listing_id NOT IN 
            (
                SELECT b.listing_id 
                FROM bookings b 
                WHERE b.book_date 
                BETWEEN ? AND ?)");
            $like = "%" . $query . "%";
            $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    return $result;
                } else {
                    echo "No listing found in that city";
                }
            } else {
                die('Connection with database was not created for ' . mysqli_error($mysqli));
            }
        }
    }
}





function filterListingsByNameDecreasing()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];

                $sql = "SELECT * FROM listing l 
            WHERE l.city LIKE ? 
            AND l.accomodates >= ? 
            AND l.listing_id NOT IN 
            (
                SELECT b.listing_id 
                FROM bookings b 
                WHERE b.book_date 
                BETWEEN ? AND ?) ORDER BY l.price DESC";

                $stmt = mysqli_prepare($mysqli, $sql);
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}


function filterListingsByNameIncreasing()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];


                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ?  AND l.listing_id NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?) ORDER BY l.price ASC");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}



function filterListingsByPetsAllowed()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];


                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ? AND l.pets_allowed = 'yes'  AND l.listing_id NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?)");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}

function filterListingsByHasWifi()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];


                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ? AND l.has_internet = 1 AND l.listing_id  NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?)");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}

function filterListingsByHasAc()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];

                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ? AND l.has_ac = 1 AND l.listing_id NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?)");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}

function filterListingsByHasKitchen()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];

                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ? AND l.has_kitchen = 1 AND l.listing_id NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?)");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}

function filterListingsByHasTv()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];

                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ? AND l.has_tv = 1 AND l.listing_id NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?)");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}

function filterListingsByHasHeating()
{
    global $mysqli;
    $mysqli = connectionDB();
    // Check for form submission
    if (isset($_GET["place"])) {
        if (isset($_GET["guests"])) {
            if (isset($_GET["check-in"]) &&  isset($_GET["check-out"])) {
                // Get the form data
                $query = $_GET["place"];
                $queryGN = $_GET["guests"];
                $queryCI = $_GET["check-in"];
                $queryCO = $_GET["check-out"];

                $stmt = $mysqli->prepare("SELECT * FROM listing l WHERE l.city LIKE ? AND l.accomodates >= ? AND l.has_heating= 1 AND l.listing_id NOT IN (SELECT b.listing_id FROM bookings b WHERE b.book_date BETWEEN ? AND ?)");
                $like = "%" . $query . "%";
                $stmt->bind_param("siss", $like, $queryGN, $queryCI, $queryCO);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    } else {
                        echo "No listing found in that city";
                    }
                } else {
                    die('Connection with database was not created for ' . mysqli_error($mysqli));
                }
            }
        }
    }
}