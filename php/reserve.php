<?PHP
include("functions/functions.php");


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

$noSLC = '<!DOCTYPE html>
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
    <p>You did not select the dates</p>
    <a href="property.php" class"go_back_booking">Go Back!</a>
</div>
</div>


</body>

</html>';


$check_in = $_POST['date1'];
$check_out = $_POST['date2'];


if (isset($_SESSION['user_id'])) {
    if ($check_in != "" && $check_out != "") {
        $listing_id = $_POST['listing_id'];


        $user_id = $_SESSION['user_id']['user_id'];
        $mysqli = require __DIR__ . "/database.php";


        bookProp($check_in, $check_out, $listing_id, $user_id);
    } else {
        echo $noSLC;
    }
} else {
    echo $loginprb;
}
