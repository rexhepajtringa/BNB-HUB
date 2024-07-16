<?php

// Start the session
session_start();

// Retrieve the current session user ID
$user_id = $_SESSION['user_id'];

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

    .big_container {
        display: flex;
        flex-direction: column;

        justify-content: center;
        align-items: center;
        margin: auto;
    }

    .glass {
        background: linear-gradient(129.89deg, rgba(255, 255, 255, 0.4) 13.17%, rgba(255, 255, 255, 0.1) 87.87%);
        box-shadow: 0px 4px 24px -1px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(1px);
        border-radius: 2.5rem;
    }

    .big_container {
        width: 90%;
        margin-top: 3em;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .addPropertyInfo {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 40%;
        margin-top: 3%;
        margin-left: -50px;


    }

    .item {
        padding: 0.3em;
        display: flex;
    }

    .countryitem input {

        width: 7.3rem;
        margin-right: 10px;
    }


    input {
        border-radius: 5px;
        background: #DCD7C9;
        border: 2px solid #3F4E4F;
        height: 2rem;

        font-size: larger;

    }

    #summary {
        height: 7rem;
    }

    #pets {
        background-color: #DCD7C9;
        width: 15rem;
        border-radius: 10px;
        border-color: #3F4E4F;
        color: #3F4E4F;
    }



    #drop_file_zone {
        background-color: #DCD7C9;
        border: #3F4E4F 2.5px dashed;
        width: 400px;
        /* height: 250px; */
        padding: 8px;
        padding-top: 7em;
        font-size: 18px;
        border-radius: 15px;

        padding-bottom: 6em;
        display: none;
    }

    #picturesAdded {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); */

    }

    #drag_upload_file {
        width: 50%;
        margin: 0 auto;

    }

    #drag_upload_file p {
        text-align: center;

    }

    #drag_upload_file #selectfile {
        display: none;
    }

    .item2 {

        display: flex;
        flex-direction: column;
        color: #3F4E4F;
        background-color: #DCD7C9;
        width: 15.5rem;
        border-radius: 10px;
        border: #3F4E4F 3px;
        margin-top: 15px;
        justify-content: center;


    }

    .grid-item {
        width: 90%;
        height: 90%;
        object-fit: cover;
        padding-top: 15px;
    }

    img:hover {
        content: "Remove";
        top: 3px;
        left: 3px;
        color: white;
        background-color: rgba(255, 0, 0, 0.7);
        padding: 3px;
        cursor: pointer;
    }


    img:hover {

        animation: shake 0.5s cubic-bezier(0.25, 0.1, 0.25, 1) infinite;

        animation-iteration-count: infinite;
    }

    @keyframes shake {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }

        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }

        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }

        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }

        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }

        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }

        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }

        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }

        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }

        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }

        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }

        110% {
            transform: translate(2px, 1px) rotate(1deg);
        }

        120% {
            transform: translate(-2px, -1px) rotate(-1deg);
        }

        130% {
            transform: translate(-4px, 0px) rotate(1deg);
        }

        140% {
            transform: translate(4px, 2px) rotate(0deg);
        }

        150% {
            transform: translate(2px, -1px) rotate(1deg);
        }

        160% {
            transform: translate(-2px, 2px) rotate(-1deg);
        }

        170% {
            transform: translate(-4px, 1px) rotate(0deg);
        }

        180% {
            transform: translate(4px, 1px) rotate(-1deg);
        }

        190% {
            transform: translate(-2px, -1px) rotate(1deg);
        }

        200% {
            transform: translate(2px, 2px) rotate(0deg);
        }

        210% {
            transform: translate(2px, -2px) rotate(-1deg);
        }
    }

    #pp {
        height: 2rem;
        width: 2rem;
    }

    #t {
        display: none;

    }

    #t:hover {
        cursor: pointer;
        background: var(--secondary);
    }

    #submit:hover {
        cursor: pointer;
        background: var(--secondary);
    }
    </style>
</head>

<body background="images/living_room_for_the_admin.png">
    <nav>
        <div class="logo" style="background-color: var(--secondary_hover);">
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

    </nav>

    <div class="big_container glass">
        <div class="addPropertyInfo">
            <form id="propertyform" action="addProperty.php" method="post" enctype="multipart/form-data">
                <div class="item">
                    <input type="text" id="propertyName" name="propertyName" placeholder="Property Name"
                        style="width: 18rem;">
                </div>
                <div class="item">
                    <div class="countryitem">
                        <input type="text" id="country" name="country" placeholder="Country">
                    </div>
                    <div class="countryitem">
                        <input type="text" id="city" name="city" placeholder="City">
                    </div>

                </div>

                <div class="item">
                    <input type="text" id="address" name="address" placeholder="Address" style="width: 18rem;">

                </div>
                <div class="item">
                    <input type="text" id="summary" name="summary" placeholder="Summary" style="width: 18rem;">
                </div>
                <div class="item">
                    <input type="number" min="0" id="accomodates" name="accomodates" placeholder="Accomodates"
                        style="width: 18rem;">
                </div>
                <div class="item">
                    <input type="text" id="surface" name="surface" placeholder="Surface" style="width: 18rem;">
                </div>
                <div class="item">
                    <input type="number" min="0" id="bedrooms" name="bedrooms" placeholder="Bedrooms"
                        style="width: 18rem;">
                </div>
                <div class="item">
                    <input type="number" min="0" id="beds" name="beds" placeholder="Beds" style="width: 18rem;">
                </div>
                <div class="item">
                    <input type="number" min="0" id="bathrooms" name="bathrooms" placeholder="Bathrooms"
                        style="width: 18rem;">
                </div>
                <div class="item">
                    <div class="item2">
                        <div class="itemmm">
                            <input type="checkbox" id="has_tv" name="has_tv" value="1">
                            <label for="has_tv"> Has TV</label><br>
                        </div>
                        <div class="item3">
                            <input type="checkbox" id="has_internet" name="has_internet" value="1">
                            <label for="has_internet">Has Internet</label><br>
                        </div>
                        <div class="item4">
                            <input type="checkbox" id="has_heating" name="has_heating" value="1">
                            <label for="has_heating">Has heating</label>
                        </div>
                        <div class="item5">

                            <input type="checkbox" id="has_ac" name="has_ac" value="1">
                            <label for="has_ac">Has AC</label>
                        </div>
                        <div class="item6">
                            <input type="checkbox" id="has_kitchen" name="has_kitchen" value="1">
                            <label for="has_kitchen">Has kitchen</label>
                        </div>
                    </div>
                </div>

                <fieldset id="pets" style="margin-top: 15px;">
                    <legend>Are pets allowed?</legend>

                    <div class="item">
                        <input type="radio" id="petsAllowed" name="pets_allowed" value="yes" checked>
                        <label for="petsAllowed">Yes</label>
                    </div>

                    <div class="item">
                        <input type="radio" id="petsnotAllowed" name="pets_allowed" value="no">
                        <label for="petsnotAllowed">No</label>
                    </div>
                </fieldset>
                <div class="item">
                    <input type="number" min="0" name="price" id="price" placeholder="Price" style="width: 18rem;">
                </div>
                <div class="item">
                    <input type="submit" id="submit" value="Submit" style="margin-top: 10px;"
                        onclick="displayImgInput();">
                </div>
        </div>
        </form>
        <form action="ajax.php" method="post">
            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file">
                    <p>Drop images here</p>
                    <p> or</p>
                    <p><input type="button" value="Select File(s)" onclick="file_explorer();" /></p>
                    <input type="file" id="selectfile" multiple />
                </div>

                <div id="picturesAdded"></div>

            </div>
            <input type="button" id="t" value="Done" style="margin-top: 10px;" onclick="location.href='index.php'">


        </form>


        <script src="custom.js"></script>
        <script>
        function displayImgInput() {
            document.getElementById('drop_file_zone').style.display = "block";
            document.getElementById('t').style.display = "block";
        }


        document.getElementById("propertyform").addEventListener("submit", async (e) => {
            e.preventDefault();
            let formData = new FormData(e.target);
            let response = await fetch("addProperty.php", {
                method: "POST",
                body: formData
            });
            let data = await response.text();
            // alert(data);
        });
        </script>


</body>

</html>