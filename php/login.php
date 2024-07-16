<?php

session_start();
include('database.php');

if(isset($_SESSION['email_pass_wrong'])){
    $session_set = true;
}
else{
    $session_set = false;
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        :root {
            --background: #A27B5C;
            --input: #DCD7C9;
            --submit: #2C3639;
        }

        

        .container,
        .sub-container,
        #login,
        body,
        #facebook-google,
        #facebook-google a {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }
        body {
            background-color: var(--background);
        }
        #home_button{
            position: absolute;
            top:0%;
            left:2%;
        }
        .container {
            margin-top: 1%;
            margin-bottom: 1%;
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
            width: 80%;
            border-radius: 15px;
            border: none;
            font-size: 30px;
            font-weight: 30px;
            text-align: center;
            margin-top: 50px;
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
            padding:10px 20px 10px 20px;
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
            object-fit: cover;
            border-radius: 40px 0px 0px 40px;
        }

        .txt-in-logo {
            display: none;
        }

        .log-in {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            
        }

        /* input templates */
        .input-container {
            position: relative;
            margin-top: 30px;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: center;
        }
        
        #surname{
            margin-left:5px;
        }
        #surname_label{
            left:53%;
        }
        .inputs{
            width:100%;
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

        @media screen and (max-width:700px) {

            body {
                background: url("f69d0c5bbe98b73197240b9c5568bc96.jpg") fixed;
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

            .log-in-input {
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid #000000;
                border-radius: 10px;
            }

            .log-in-btn {
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
        }
    </style>



</head>

<body>  
    <a id="home_button" href=""><img src="iconmonstr-eye-thin.svg"></a>
    <div class="container glass">

        <img id="house-image" src="f69d0c5bbe98b73197240b9c5568bc96.jpg">
        <div class="sub-container">
            <form action="proccess-login.php" method="post" novalidate>
                <div class="log-in">
                    <div class="big-title">
                        <h1>Log In</h1>
                        <br>
                        <br>
                    </div>
                    <div class="inputs">
                        <br>
                        <div class="input-container">
                            <input name = "email" type="text" id="email" class="text-input" autocomplete="off"
                                placeholder="Enter your email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                            <label class="label" for="email">Email</label>
                            <p id="email_warning" class="warning"></p>
                        </div>
                        <br>
                        <div class="input-container">
                            <input name = "password" type="password" id="password" class="text-input" autocomplete="off"
                                placeholder="Enter your password">
                            <label class="label" for="password">Password</label>
                            <p id="password_warning" class="warning"></p>
                            <img id="eyeimg1" src="iconmonstr-eye-off-thin.svg">
                        </div>
                        <br>
                    </div>
                    <br>

                    <input type="submit" value="Submit" class="btn" onclick="return validate()">


                </div>
            </form>
            <span id="facebook-google">
                <a id="border-line" href=""><img src="Facebook_Logo_(2019).png.webp">
                    <p class="txt-in-logo">Log in with facebook</p>
                </a>
                <a href=""><img src="GOOG-0ed88f7c.png">
                    <p class="txt-in-logo">Log in with google</p>
                </a>
            </span>
            <a id="login-link" href="Sign-Up.php">Don't Have An Account</a>

        </div>
        
    </div>
    <script>


            let email_warning = document.getElementById("email_warning");
            var session_set = <?php echo json_encode($session_set);?>;        

            if(session_set){
                email_warning.innerText = "Email or Password is incorrect";
                email_warning.style.display = "block";

            }

        function validate() {
            document.querySelectorAll(".warning").forEach((element) => {
                element.style.display = "none";
            });

            let email_warning = document.getElementById("email_warning");
            let password_warning = document.getElementById("password_warning");


            
        }

        let eyeimg1 = document.getElementById("eyeimg1");
        eyeimg1.addEventListener("mousedown", function () {
            lipEyeImg();
        });
        eyeimg1.addEventListener("mouseup", function () {
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
    </script>
    <?php unset($_SESSION['email_pass_wrong']);?>
</body>

</html>