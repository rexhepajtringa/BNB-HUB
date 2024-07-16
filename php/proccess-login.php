<?php
session_start();
include('database.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf(
        "SELECT * FROM user
                    WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["password"], $user["password"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user;

            if ($_SESSION["user_id"]["admin_check"] == '1') {
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }



            exit;
        }
    }

    $_SESSION['email_pass_wrong'] = '1';
    header("Location: Sign-Up.php");
}