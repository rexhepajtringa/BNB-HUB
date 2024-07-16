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
    <title>My Geocode App</title>
</head>
<style>
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


#map {
    position: relative;
    height: 600px;
    width: 70%;
    left: 15%;
    border-radius: 20px;
}

mapcont {
    width: 100%;
}

.title {
    width: 100%;
}

.title h1 {
    display: inline;
    justify-content: center;
    position: relative;
    left: 35%;
    padding-top: 10%;
    color: var(#c41b1b);
    font-family: arial;
}

.back {
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif;
    position: relative;
    top: 3rem;
    left: 45%;
    background-color: aliceblue;
    color: #3f4e4f;
    font-size: 28px;
    padding-left: 2rem;
    padding-right: 2rem;
    padding-bottom: 1rem;
    padding-top: 1rem;
    border-radius: 20px;
    transition: .5s;
}

.back:hover {
    color: #a27b5c;
    background-color: #3f4e4f;
}
</style>

<body>

    <?php
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $whole = $address . " " . $city . " " . $country;

    ?>
    <br>
    <br>
    <div class="title">
        <h1><?php echo $whole ?></h1>
    </div>
    <br>
    <br>
    <br>
    <div class="mapcont">
        <div id="map">
        </div>
    </div>

    <a href="property.php" class="back">GO BACK</a>


    <script>
    const convertToLatLng = async (address) => {
        try {
            // make a GET request to the OpenStreetMap Nominatim API
            const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${address}&format=json`);
            // parse the response as json
            const data = await response.json();
            // get the first result from the json
            const result = data[0];
            // return the latitude and longitude
            return {
                lat: result.lat,
                lng: result.lon
            };
        } catch (err) {
            console.log(err);
        }
    };

    // example usage
    var address = "<?php echo $whole; ?>";
    convertToLatLng(address)
        .then(({
            lat,
            lng
        }) => {
            initMap(lng, lat);
        });

    // const address = "Sunnewisstrasse 5, 8483 Zurich Switzerland";
    // convertToLatLng(address)
    // .then(({
    // lat,
    // lng
    // }) => {
    // initMap(lng, lat);
    // });

    function initMap(longitude, latitude) {
        var options = {
            zoom: 15,
            center: new google.maps.LatLng(latitude, longitude)
        }
        var map = new google.maps.Map(document.getElementById("map"), options);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            map: map
        });
    }
    </script>

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD25OanEu2NWheyMIZKeKKu_6hRIzj4L6U&callback=initMap">
    </script>
    <!-- <script async
        src="https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyD25OanEu2NWheyMIZKeKKu_6hRIzj4L6U">
    </script> -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD25OanEu2NWheyMIZKeKKu_6hRIzj4L6U">
    </script>
</body>




</html>