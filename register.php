<!DOCTYPE html>
<html lang="en">

<?php
require "global.php";
$value_error = "";
//$con = mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $value_error = "An email is required";
    }
    else {
        $email = $_POST["email"];
        if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `user` WHERE email='$email'"))) {
            $value_error = "This email is already taken";
        } else {
            require "auth.php";
            register($_POST["username"], $email, $_POST["password"]);
        }
    }

    if (empty($_POST["password"])) $value_error = "A password is required";
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
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

                <form id="register" class="input-group-reg" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">  <!--post- kogato shte wkarwam information v database // get- kogato slaga information-->  
                    <input id="username" name="username" type="text" class="input-field" placeholder="User" required>
                    <input id="email" name="email" type="email" class="input-field" placeholder="Email" required>
                    <span id="value_error"><?php echo $value_error; ?></span>
                    
                    <input id="password" name="password" type="password" class="input-field" placeholder="Enter Password" required>
                    <button type="submit" class="submit-btn">Register</button>
                    <br>
                    <button type="button" class="submit-btn"onclick="login_ref()">Already have an account?</button>
                    <br>
                    <button type="button" class="submit-btn" onclick="back()">Back</button>
                    
                    <input type="hidden" name="auth_type" value="register">
                </form>
            </div>    
        </div>
    </div>

    <script type="text/javascript" src="login.js"></script>
</body>

</html>
