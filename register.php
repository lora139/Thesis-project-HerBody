<!DOCTYPE html>
<html lang="en">

    <?php
        require "global.php";
        $value_error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (empty($_POST["email"]))
            { // ако няма имейл, ако не е написан такъв
                $value_error = "An email is required";
            }else if(empty($_POST["username"]))
            {
                $value_error = "An username is required";
            }
            else 
            {
                $email = $_POST["email"];
                $username = $_POST["username"];
                if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `user` WHERE email='$email'")))
                { //ако се регистрираш с вече съществуващ имейл
                    $value_error = "This email is already taken";
                } 
                else if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM `user` WHERE username='$username'")))
                {
                    $value_error = "This username is already taken";
                }
                {
                    require "auth.php";
                    register($_POST["username"], $email, $_POST["password"]);
                }
            } 
            if (empty($_POST["password"])) $value_error = "A password is required"; // необхофима е парола
        }
    ?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/login.css">
        <script type="text/javascript" src="/js/login.js"></script>
        <title>Sign in</title>
    </head>

    <body>
        <div class="hero">
            <div class="box">
                <div class="form-box">
                    <div class="button-box">
                        <div id="btn"></div>
                        <p class="toggle-btn">Register</p>
                    </div>

                    <form id="register" class="input-group-reg" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">  <!--post- когато ще вкарваме информация в базата данни // get- когато се задава информация-->  
                        <span id="value_error"><?php echo $value_error; ?></span> <!--при възникване на грешка-->
                        <input id="username" name="username" type="text" class="input-field" placeholder="User" required>
                        <input id="email" name="email" type="email" class="input-field" placeholder="Email" required>
                        <input id="password" name="password" type="password" class="input-field" placeholder="Enter Password" required>
                        <div>
                            <br><br>
                            <button type="submit" class="submit-btn-r">Register</button>
                            <br>
                            <button type="button" class="submit-btn-r"onclick="login_ref()">Already have an account?</button>
                            <br>
                            <button type="button" class="submit-btn-r" onclick="back()">Back</button>
                        </div>
                        <input type="hidden" name="auth_type" value="register">
                    </form>
                </div>    
            </div>
        </div>
    </body>
</html>
