<?php
session_start();
include('database.php');
if (isset($_SESSION['user_id'])) {
    $session_set = true;
    $id = $_SESSION['user_id']['user_id'];
    $clientName = $_SESSION['user_id']['first_name'];
    $profile_pic = $_SESSION['user_id']['profile_pic'];
} else {
    $session_set = false;
}


if (isset($_POST['submit'])) {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];



        $fileExt = explode('.', $fileName);
        // explode same as split in java

        $fileActualExt = strtolower(end($fileExt));
        // end() gets last piece of data from an array

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    }
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['mobile'];

    $gender;
    if (isset($_POST['gender'])) {
        global $gender;
        $kategoryInput = $_POST['gender'];
        switch ($kategoryInput) {
            case "Male":
                $gender = 1;
                break;
            case "Female":
                $gender = 2;
                break;
            case "Other":
                $gender = 3;
                break;
        }
    }

    if (in_array($fileActualExt, $allowed)) {

        if ($fileError === 0) {

            if ($fileSize < 1000000) {
                // $fileNameNew = uniqid('',true) . "." . $fileActualExt;
                echo $fileName;

                // $fileDestination = 'uploads/' . $fileNameNew;

                $fileDestination = 'uploads/' . $fileName;
                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone', email = '$email', gender = '$kategoryInput', profile_pic ='$fileDestination' WHERE user_id ='$id'";

                $result = mysqli_query($mysqli, $sql);
                if ($result) {
                    unset($_SESSION['user_id']);
                    header('Location: Sign-Up.php');
                } else {
                    die('There was an error connecting with database: ' . mysqli_error($mysqli));
                }
            }
        }
    } else {
        $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone', email = '$email', gender = '$kategoryInput' WHERE user_id ='$id'";

        $result = mysqli_query($mysqli, $sql);

        if ($result) {

            unset($_SESSION['user_id']);
            header('Location: Sign-Up.php');
        } else {
            die('There was an error connecting with database: ' . mysqli_error($mysqli));
        }
    }
}