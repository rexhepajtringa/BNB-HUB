<?PHP
include("functions/functions.php");






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


$loginprb = '<!DOCTYPE html>
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

$listing_id = $_POST['listing_id'];

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id']['user_id'];
    $mysqli = require __DIR__ . "/database.php";

    $sql = "INSERT INTO wishlist (user_id,listing_id) VALUES ('$user_id','$listing_id')";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        header("Location: listing.php");
    } else {
        // echo $declined;
        die('The mistake is at: <br>' . mysqli_error($mysqli));
    }
} else {
    echo $loginprb;
}