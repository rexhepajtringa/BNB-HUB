<?php

// Start the session
session_start();

// Retrieve the current session user ID
// $user_id = $_SESSION['user_id'] ;

if(isset($_SESSION['user_id'])){
    $session_set = true;
    $name = $_SESSION['user_id']['first_name'];
    $lastname=$_SESSION['user_id']['last_name'];
    $email = $_SESSION['user_id']['email'];
    $phone=$_SESSION['user_id']['phone_number'];
    $gender=$_SESSION['user_id']['gender'];
    $profilepic = $_SESSION['user_id']['profile_pic'];

}
else{
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

    body {
        background: url("images/living_room_for_the_admin.png") fixed;
        /* background-position: center; */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
        /* background-size: cover; */
    }

    /*! colors */
    :root {
        --primary_light_one: #e3e2df;
        --primary_light_two: #eae7dc;
        --primary_light_three: #dcd7c9;
        --secondary: #dbdffd;
        --secondary_hover: #9ba3eb;
        --action: #646fd4;
        --action_primary: #242f9b;
        
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


    .big_container, form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: auto;
    }
    form{
      width:100%;
    }

    .glass {
      background: linear-gradient(129.89deg, rgba(255, 255, 255, 0.4) 13.17%, rgba(255, 255, 255, 0.1) 87.87%);
      box-shadow: 0px 4px 24px -1px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(1px);
      border-radius: 2.5rem;
    }

    .big_container {
      width: 80%;
      margin-top: 3em;
      flex-wrap: wrap;
      padding: 10px;
      padding-bottom:2em;
    }
    .section{
      display:flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }
    .addPropertyInfo{
      width:100%;
      display:flex;
      flex-direction: row;
      justify-content: space-evenly;
      align-items: center;
      flex-wrap: wrap;
    }

    .item {
      padding: 0.3em;
      display: flex;
      align-items: center;
    }

    .countryitem input {
      width: 8rem;
      margin-right: 10px;
    }

    .nav-links li a .account img {
    position: relative;
    height: 2rem;
    width: 2rem;
    top: .4rem;
    border-radius: 50%;
}

    input {
      border-radius: 5px;
      background: #DCD7C9;
      border: 2px solid #3F4E4F;
      height: 2rem;
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

    .remove_user_container {
      width: 321.35px;
      height: 343px;
      background: #EAE7DC;
      border-radius: 25px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: 20px;
    }

    .remove_user_container h3 {
      font-family: 'Inter';
      font-style: normal;
      font-weight: 400;
      font-size: 26px;
      line-height: 31px;
      text-align: center;
      color: #646FD4;
    }

    .remove_user_container img {
      width: 199px;
      height: 199px;
      border-radius: 50%;
    }

    .remove_user_container button {
      width: 161.11px;
      height: 46.77px;
      background: #2C3639;
      border: none;
      border-radius: 25px;
      font-family: 'Inter';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      line-height: 29px;
      text-align: center;
      color: #E3E2DF;
    }

    .submitbutton input {
      width: 161.11px;
      height: 46.77px;
      background: #2C3639;
      border: none;
      border-radius: 5px;
      font-family: 'Inter';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      line-height: 29px;
      text-align: center;
      color: #E3E2DF;
    }

    #edit_image {
      width: 161.11px;
      height: 36.77px;
      background: #2C3639;
      border: none;
      border-radius: 5px;
      font-family: 'Inter';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      line-height: 29px;
      text-align: center;
      color: #E3E2DF;
    }
    .remove_user_container{
      display:flex;
      flex-direction: column;
      justify-content: space-evenly;
      align-items: center;
      
    }

    #file {
      width: 6em;
    }
    
    #submit:hover{
      cursor: pointer;
    }
  </style>
</head>

<body background="images/pexels-dada-design-12277293 1.png">
<nav>
        <div class="logo" style="background-color: var(--secondary_hover);" >
            <img src="images/LOGO_USER.png">
            <h4>BNBHUB</h4>
        </div>
        <ul class="nav-links">
            <li class="link" style="padding-right: 25px;">
                <a href="admin.php">Home</a>
            </li>
            <li class="link">
                <a href="addPropertyAdmin.php">Add Property</a>
            </li>
            <li class="link">
                <a href="remove_property.php">Remove Property</a>
            </li>
            <li class="link">
                <a href="remove_users.php">Remove Account</a>
            </li>
            <li class="link">
                <a href="#">
                    <div class="account" id="boom" style="background-color: var(--secondary_hover);">
                        <h4 id="loggedin" >Hi <?php echo $name?></h4>
                        <img src="<?php echo $profilepic ?>">
                    </div>
                </a>
            </li>
            
        </ul>

    </nav>

    <!-- ? The Nav Bar-->
    <!-- ? Burger only on mobile mode-->
    <div class="burger">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
    </div>
  </nav>
  <div class="big_container glass">

    
<form action="edit_user-process.php" enctype="multipart/form-data" method="POST">
  <div class="addPropertyInfo">
    <div class="section">
  <div class="item">
    <div class="countryitem">
      <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $name ?>">
    </div>
    <div class="countryitem">
      <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $lastname ?>">
    </div>

  </div>

  <div class="item">
    <input type="text" id="email" name="email" placeholder="email" style="width: 18rem;"
      value="<?php echo $email ?>">

  </div>

  <div class="item">
    <input type="number" id="mobile" name="mobile" placeholder="mobile" style="width: 18rem;"
      value="<?php echo $phone ?>">
  </div>
  <fieldset id="pets" style="margin-top: 15px;">
    <legend>Gender</legend>

    <div class="item">
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">Male</label>
    </div>

    <div class="item">
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label>
    </div>

    <div class="item">
      <input type="radio" id="other" name="gender" value="other">
      <label for="other">Other</label>
    </div>

  </fieldset>
</div>


<div class="remove_user_container">
  <img id="display_image" src="<?php echo $profilepic ?>">
  <label id="edit_image" for="file">Edit image</label>
  <input type="file" id="file" class="btn-delete" name="file" style="visibility:hidden;" value="edit image">

</div>


</div>
<div class="submitbutton">
<input type="submit" id="submit" name="submit" value="Confirm">
</div>


</form>


<div class="submitbutton">
<input type="submit" id="submit" name="logout" value="Log Out" style="margin-top: 15px;" onclick="logout()";>
</div>

</div>


   





  <script>
    
    let x = document.getElementsByName("gender");
    for (i = 0; i < x.length; i++) {
      if (x[i].value === '<?php echo $gender ?>') {
        x[i].checked = true;
      }
    }

    const image_input =document.querySelector("#file");
        var uploaded_image = "";

        image_input.addEventListener("change", function(){
          const reader = new FileReader();
          reader.addEventListener("load", ()=> {
            uploaded_image = reader.result;
            document.querySelector("#display_image").src = `${uploaded_image}`;
          });
          reader.readAsDataURL(this.files[0]);
        })
        
        function logout(e) {
    // e.preventDefault();  // prevent the form from submitting
    fetch("logout.php", {
        method: "POST",
    }).then(response => {
        if (response.ok) {
            // handle success
            window.location.href = "index.php";
        } else {
            // handle error
            console.log("Error logging out");
        }
    });
}

  </script>
  <script src="js/app.js"></script>
</body>