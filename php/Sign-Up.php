<?php

session_start();
include('database.php');

if (isset($_SESSION['email_pass_wrong'])) {
    $session_set2 = true;
} else {
    $session_set2 = false;
}
$message = '';

if (isset($_SESSION['email_alert'])) {
    $session_set = true;
} else {
    $session_set = false;
}
if (isset($_SESSION['signed_up'])) {
    $session_set3 = true;
} else {
    $session_set3 = false;
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    :root {
        --background: #4F7942;
        --background2: #A27B5C;
        --input: #DCD7C9;
        --submit: #2C3639;
    }



    @keyframes transitionIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .container,
    .sub-container,
    #login,
    #signup,
    body,
    #facebook-google,
    #facebook-google a {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
    }

    body {
        z-index: 1;
        background: linear-gradient(-45deg, #FF7E5F, #DB350D, #BB7742, #FF7E5F);
        background-size: 400% 400%;
        animation: myanimate 10s ease infinite, transitionIn 0.75s;
    }

    @keyframes myanimate {
        0% {
            background-position: 0 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0 50%;
        }
    }


    #home_button {
        position: absolute;
        top: 0%;
        left: 2%;
    }

    .container,
    .card {
        margin-top: 3em;
        margin-bottom: 3em;
        box-sizing: border-box;
        height: 43.125em;
        width: 70.5em;
    }

    .glass {
        background: linear-gradient(129.89deg, rgba(255, 255, 255, 0.4) 13.17%, rgba(255, 255, 255, 0.1) 87.87%);
        box-shadow: 0px 4px 24px -1px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(1px);
        border-radius: 40px;
    }

    .sub-container {
        flex-direction: column;
        width: 35%;
        height: 100%;
    }

    .btn {
        background-color: var(--submit);
        color: #FFFFFF;
        text-decoration: none;
        height: 1.910625em;
        width: 60%;
        border-radius: 15px;
        border: none;
        font-size: 30px;
        font-weight: 30px;
        text-align: center;
        margin-top: 20px;
    }

    #facebook-google {
        width: 60%;
        justify-content: center;
        border-top: 2px solid rgba(0, 0, 0, 0.35);
        padding-top: 10px;
    }

    #facebook-google img {
        width: 5.975em;
        height: auto;
        padding: 10px 20px 10px 20px;
    }

    #border-line {
        border-right: 2px solid rgba(0, 0, 0, 0.35);

    }

    #login-link {
        margin-top: 30px;
        color: black;
        font-size: 15px;
    }

    #house-image {
        width: 65%;
        height: 100%;
        border-radius: 0px 40px 40px 0px;
    }

    .txt-in-logo {
        display: none;
    }

    .sign-up {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

    }

    /* input templates */
    .input-container {
        position: relative;
        margin-top: 10px;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: center;
    }

    #surname {
        margin-left: 5px;
    }

    #surname_label {
        left: 53%;
    }

    .inputs {
        width: 60%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .label,
    .input-container p,
    .input-container img {
        position: absolute;
        left: 10px;
        top: 14px;
        transition: all 0.2s;
        padding: 0 2px;
        z-index: 1;
        color: var(--darkTwo);
    }

    .input-container p {
        display: none;
        color: red;
        margin-top: 35px;
    }

    .input-container img {
        margin-left: 83%;
    }

    .text-input {
        padding: 0.8rem;
        width: 100%;
        height: 100%;
        border: 2px solid #794545;
        background: transparent;
        border-top: none;
        border-left: none;
        border-right: none;
        border-radius: 10px;
        font-size: 18px;
        outline: none;
        transition: all 0.3s;
        color: var(--darkOne);
    }

    .label::before {
        content: "";
        height: 5px;
        position: absolute;
        left: 0;
        top: 10px;
        width: 100%;
        z-index: -1;
    }

    .text-input:focus {
        border: 2px solid #794545;
        border-top: none;
    }

    .text-input:focus+.label,
    .filled {
        top: -10px;
        color: var(--mainColor);
        font-size: 14px;
    }

    .text-input::placeholder {
        font-size: 16px;
        opacity: 0;
        transition: all 0.3s;
    }

    .text-input:focus::placeholder {
        opacity: 1;
    }

    /* .card {
  margin: 100px auto 0;
  width: 400px;
  height: 600px;
  perspective: 1000px;
} */

    .card__inner {
        width: 100%;
        height: 100%;
        transition: transform 1s;
        transform-style: preserve-3d;
        cursor: pointer;
        position: relative;
    }

    .card__inner.is-flipped {
        transform: rotateY(180deg);
    }


    .card__face {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        overflow: hidden;
        border-radius: 40px;
        box-shadow: 0px 3px 18px 3px rgba(0, 0, 0, 0.2);
    }

    .card__face--front {
        background-image: linear-gradient(to bottom right, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        transform: rotateX(0deg);
    }

    .card__face--front h2 {
        color: #FFF;
        font-size: 32px;
    }

    .card__face--back {
        background-color: var(--light);
        transform: rotateY(180deg);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card__content {
        width: 100%;
        height: 100%;
    }

    .card__header {
        position: relative;
        padding: 30px 30px 40px;
    }

    .card__header:after {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: linear-gradient(to bottom left, var(--primary) 10%, var(--secondary) 115%);
        z-index: -1;
        border-radius: 0px 0px 40px 0px;
    }

    .pp {
        display: block;
        width: 128px;
        height: 128px;
        margin: 0 auto 30px;
        border-radius: 50%;
        background-color: #FFF;
        border: 5px solid #FFF;
        object-fit: cover;
    }

    .card__header h2 {
        color: #FFF;
        font-size: 32px;
        font-weight: 900;
        text-transform: uppercase;
        text-align: center;
    }

    .card__body {
        padding: 30px;
    }

    .card__body h3 {
        color: var(--dark);
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .card__body p {
        color: var(--dark);
        font-size: 18px;
        line-height: 1.4;
    }

    .login_inputs {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
    }

    .login_input {
        width: 200px;
    }

    @media screen and (max-width:700px) {

        body {
            background: url("50cbd008cf18137b71f78a02938fc4a7.jpg") fixed;
            background-size: cover;
            background-position: center;
        }

        #house-image {
            display: none;
        }


        .text-input {
            background-color: var(--input);
        }

        .container {
            height: 110vh;
        }

        .sub-container {
            width: 100%;
            height: 60vh;
        }

        .sign-up-input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid #000000;
            border-radius: 10px;
        }

        .sign-up-btn {
            background: #0E64D2;
            border-radius: 20px;
        }

        #facebook-google {
            flex-direction: column;
            padding-top: 20px;
            margin-top: 10px;
        }

        #facebook-google a {
            width: 100%;
            padding: 10px 1px 10px 0px;
            border: 1px solid #000000;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            height: 70px;
        }

        #border-line {
            margin-bottom: 20px;
            background-color: #1877F2;
        }

        #border-line p {
            color: white;
        }

        #facebook-google img {
            width: 5.375em;
            height: auto;
        }

        .txt-in-logo {
            display: contents;
        }

        .log-in-input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid #000000;
            border-radius: 10px;
        }

        .log-in-btn {
            background: #0E64D2;
            border-radius: 20px;
        }
    }
    </style>
</head>

<body>
    <!-- <div class="container glass">

        <div class="sub-container">
            <form>
                <div class="sign-up">
                    <div class="big-title">
                        <h1>Sign Up</h1>
                        <br>
                        <br>
                    </div>
                    <div class="inputs">
                    <div class="input-container">
                        <input type="text" id="name" class="text-input" autocomplete="off"
                            >
                        <label class="label" for="name">Name</label>
                        <p id="name_warning" class="warning"></p>

                        <input type="text" id="surname" class="text-input" autocomplete="off"
                            >
                        <label class="label" id="surname_label" for="surname">Surname</label>
                        <p id="surname_warning" class="warning"></p>
                    </div>
                    <br>
                    <div class="input-container">
                        <input type="text" id="email" class="text-input" autocomplete="off"
                            placeholder="Enter your email">
                        <label class="label" for="email">Email</label>
                        <p id="email_warning" class="warning"></p>
                    </div>
                    <br>
                    <div class="input-container">
                        <input type="tel" id="phone_number" class="text-input" autocomplete="off"
                            placeholder="Enter your phone number">
                        <label class="label" for="phone_number">Phone Number</label>
                        <p id="phone_number_warning" class="warning"></p>
                        
                    </div>
                    <br>
                    <div class="input-container">
                        <input type="password" id="password" class="text-input" autocomplete="off"
                            placeholder="Enter your password">
                        <label class="label" for="password">Password</label>
                        <p id="password_warning" class="warning"></p>
                        <img id="eyeimg1" src="iconmonstr-eye-off-thin.svg">
                    </div>
                    <br>
                    <div class="input-container">
                        <input type="password" id="confirm-password" class="text-input" autocomplete="off"
                            placeholder="Enter your password">
                        <label class="label" for="confirm-password">Confirm-Password</label>
                        <p id="confrim_password_warning" class="warning"></p>

                    </div>
                    </div>
                    <br>

                    <input type="submit" value="Sign Up" class="btn" onclick="return validate()">


                </div>
            </form>
            <span id="facebook-google">
                <a id="border-line" href=""><img src="Facebook_Logo_(2019).png.webp">
                    <p class="txt-in-logo">Sign up with facebook</p>
                </a>
                <a href=""><img src="GOOG-0ed88f7c.png">
                    <p class="txt-in-logo">Sign up with google</p>
                </a>
            </span>
            <a id="login-link"  href="">Already have an account</a>

        </div>
        <img id="house-image" src="50cbd008cf18137b71f78a02938fc4a7.jpg">
    </div> -->



    <div class="card container">
        <div class="card__inner">
            <div class="card__face card__face--front">


                <div class="sub-container">
                    <form action="process-signup.php" method="post" novalidate>
                        <div class="sign-up">
                            <div class="big-title">
                                <h1>Sign Up</h1>
                                <br>
                                <br>
                            </div>
                            <div class="inputs">
                                <div class="input-container">
                                    <input type="text" name="first_name" id="name" class="text-input"
                                        autocomplete="off">
                                    <label class="label" for="name">Name</label>
                                    <p id="name_warning" class="warning"></p>

                                    <input type="text" name="last_name" id="surname" class="text-input"
                                        autocomplete="off">
                                    <label class="label" id="surname_label" for="surname">Surname</label>
                                    <p id="surname_warning" class="warning"></p>
                                </div>
                                <br>
                                <div class="input-container">
                                    <input type="text" name="email" id="email" class="text-input" autocomplete="off"
                                        placeholder="Enter your email">
                                    <label class="label" for="email">Email</label>
                                    <p id="email_warning" class="warning"></p>
                                </div>
                                <br>
                                <div class="input-container">
                                    <input type="tel" name="phone_number" id="phone_number" class="text-input"
                                        autocomplete="off" placeholder="Enter your phone number">
                                    <label class="label" for="phone_number">Phone Number</label>
                                    <p id="phone_number_warning" class="warning"></p>

                                </div>
                                <br>
                                <div class="input-container">
                                    <input type="password" name="password" id="password" class="text-input"
                                        autocomplete="off" placeholder="Enter your password">
                                    <label class="label" for="password">Password</label>
                                    <p id="password_warning" class="warning"></p>
                                    <img id="eyeimg1" src="images/iconmonstr-eye-off-thin.svg">
                                </div>
                                <br>
                                <div class="input-container">
                                    <input type="password" name="confirm-password" id="confirm-password"
                                        class="text-input" autocomplete="off" placeholder="Enter your password">
                                    <label class="label" for="confirm-password">Confirm-Password</label>
                                    <p id="confrim_password_warning" class="warning"></p>

                                </div>
                            </div>
                            <br>

                            <input type="submit" value="Sign Up" class="btn" onclick="return validate()">


                        </div>
                    </form>
                    <!-- <span id="facebook-google">
                        <a id="border-line" href=""><img src="img/Facebook_Logo_(2019).png.webp">
                            <p class="txt-in-logo">Sign up with facebook</p>
                        </a>
                        <a href=""><img src="img/GOOG-0ed88f7c.png">
                            <p class="txt-in-logo">Sign up with google</p>
                        </a>
                    </span> -->
                    <p id="login-link" href="">Already have an account</p>

                </div>
                <img id="house-image" src="images/signup.jpg">
            </div>

            <div class="card__face card__face--back">
                <div class="sub-container">
                    <form action="proccess-login.php" method="post" novalidate>
                        <div class="sign-up">
                            <div class="big-title">
                                <h1>Log in</h1>
                                <br>
                                <br>
                            </div>
                            <div class="inputs login_inputs">



                                <div class="input-container">
                                    <input type="text" name="email" id="email2" class="text-input login_input"
                                        autocomplete="off" placeholder="Enter your email"
                                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                                    <label class="label" for="email">Email</label>
                                    <br>
                                    <p id="email_warning2" class="warning"></p>
                                </div>

                                <br><br>
                                <div class="input-container">
                                    <input name="password" type="password" id="password2" class="text-input login_input"
                                        autocomplete="off" placeholder="Enter your password">
                                    <label class="label" for="password">Password</label>
                                    <br>
                                    <p id="password_warning2" class="warning"></p>
                                    <img id="eyeimg2" src="images/iconmonstr-eye-off-thin.svg">
                                </div>

                            </div>


                            <input type="submit" value="Sign in" class="btn login_input" onclick="return validate2()">


                        </div>
                    </form>
                    <span id="facebook-google">
                        <!-- <a id="border-line" href="">
                            <p class="txt-in-logo">Sign up with facebook</p>
                        </a>
                        <a href=""><img src="images/GOOG-0ed88f7c.png">
                            <p class="txt-in-logo">Sign up with google</p>
                        </a>
                    </span> -->
                        <p id="login-link-2" href="">Don't have an account</p>

                </div>
                <img id="house-image" src="images/login.jpg">
            </div>

        </div>
    </div>
    </div>


    <script>
    function validate() {
        document.querySelectorAll(".warning").forEach((element) => {
            element.style.display = "none";
        });

        let name = document.getElementById("name");
        let surname = document.getElementById("surname");
        let email = document.getElementById("email");
        let password = document.getElementById("password");
        let confirm_password = document.getElementById("confirm-password");
        let name_warning = document.getElementById("name_warning");
        let surname_warning = document.getElementById("surname_warning");
        let email_warning = document.getElementById("email_warning");
        let password_warning = document.getElementById("password_warning");
        let confirm_password_warning = document.getElementById("confrim_password_warning");

        if (name.value == "") {
            name_warning.innerText = "Name can not be empty";
            name_warning.style.display = "block";
            return false;
        }
        if (surname.value == "") {
            surname_warning.innerText = "Surname can not be empty";
            surname_warning.style.display = "block";
            return false;
        } else if (email.value == "") {
            email_warning.innerText = "Email can not be empty";
            email_warning.style.display = "block";
            return false;
        } else if (!email.value.match('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$')) {
            email_warning.innerText = "this email is not in correct format";
            email_warning.style.display = "block";
            return false;
        } else if (password.value == "") {
            password_warning.innerText = "Password can not be empty";
            password_warning.style.display = "block";
            return false;
        } else if (password.value.length < 8) {
            password_warning.innerText = "Password can not be less than 8 charcters";
            password_warning.style.display = "block";
            return false;
        } else if (!password.value.match(/[0-9]/)) {
            password_warning.innerText = "Password should contain at least one number";
            password_warning.style.display = "block";
            return false;
        } else if (!password.value.match(/[a-z]/i)) {
            password_warning.innerText = "Password should contain at least one character";
            password_warning.style.display = "block";
            return false;
        } else if (!password.value.match(/[@$!%#+=()\^?&]/)) {
            password_warning.innerText = "Password should conatin at least one special character";
            password_warning.style.display = "block";
            return false;
        } else if (!(password.value === confirm_password.value)) {
            confirm_password_warning.innerText = "should be the same";
            confirm_password_warning.style.display = "block";
            return false;
        } else {

            return true;
        }
    }

    let eyeimg1 = document.getElementById("eyeimg1");
    eyeimg1.addEventListener("mousedown", function() {
        lipEyeImg();
    });
    eyeimg1.addEventListener("mouseup", function() {
        eyeimg1.src = "iconmonstr-eye-off-thin.svg";
        let password = document.getElementById("password").type = 'password';
        let confirm_password = document.getElementById("confirm-password").type = 'password';
    });

    function lipEyeImg() {
        let eyeimg1 = document.getElementById("eyeimg1").src = "iconmonstr-eye-thin.svg";
        let password = document.getElementById("password").type = 'text';
        let confirm_password = document.getElementById("confirm-password").type = 'text';
    }




    document.querySelectorAll(".text-input").forEach((element) => {
        element.addEventListener("blur", (event) => {
            if (event.target.value != "") {
                event.target.nextElementSibling.classList.add("filled");
            } else {
                event.target.nextElementSibling.classList.remove("filled");
            }
        });
    });


    let email_warning2 = document.getElementById("email_warning2");
    var session_set = <?php echo json_encode($session_set2); ?>;
    var session_set2 = <?php echo json_encode($session_set); ?>;
    var session_set3 = <?php echo json_encode($session_set3); ?>;

    if (session_set) {
        email_warning2.innerText = "Email or Password is incorrect";
        email_warning2.style.display = "block";

    }

    function validate2() {
        document.querySelectorAll(".warning").forEach((element) => {
            element.style.display = "none";
        });

        let email_warning2 = document.getElementById("email_warning2");
        let password_warning2 = document.getElementById("password_warning2");



    }

    let eyeimg2 = document.getElementById("eyeimg2");
    eyeimg2.addEventListener("mousedown", function() {
        lipEyeImg2();
    });
    eyeimg2.addEventListener("mouseup", function() {
        eyeimg2.src = "iconmonstr-eye-off-thin.svg";
        let password2 = document.getElementById("password2").type = 'password';

    });

    function lipEyeImg2() {
        let eyeimg2 = document.getElementById("eyeimg2").src = "iconmonstr-eye-thin.svg";
        let password2 = document.getElementById("password2").type = 'text';

    }




    document.querySelectorAll(".text-input").forEach((element) => {
        element.addEventListener("blur", (event) => {
            if (event.target.value != "") {
                event.target.nextElementSibling.classList.add("filled");
            } else {
                event.target.nextElementSibling.classList.remove("filled");
            }
        });
    });




    const card = document.querySelector(".card__inner");
    let x = document.getElementById("login-link");
    let y = document.getElementById("login-link-2");

    x.addEventListener("click", function(e) {
        card.classList.toggle('is-flipped');
    });
    y.addEventListener("click", function(e) {
        card.classList.toggle('is-flipped');
    });
    if (session_set == true || session_set2 == true) {
        card.classList.toggle('is-flipped');
    }
    if (session_set3 == true) {
        card.classList.toggle('is-flipped');
    }
    </script>
    <?php unset($_SESSION['email_pass_wrong']); ?>
</body>

</html>