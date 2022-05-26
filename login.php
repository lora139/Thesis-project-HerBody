<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Sign in</title>
</head>

<?php
require 'util.php';

$email_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo '23ewaeaeadsadasdwq3e342q32q3232';
    if (empty($_POST["email"])) {
        $email_error = "An email is required";
    } else {
        $email = $_POST['email'];
        $q = "SELECT * FROM `user` WHERE email='$email'";
        if (mysqli_num_rows(mysqli_query($con, $q))) {
            $email_error = "This email is already taken";
        } else {
            register();
        }
    }
}
?>

<body>
    <div class="hero">
        <div class="box">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="window.location.hash='#login'; login()">Log in</button>
                    <button type="button" class="toggle-btn" onclick="setTimeout(function() { hash() },300); register()">Register</button>
                </div>

                <form id="login" class="input-group" method="POST" action="db_log.php">
                    <input id="username" name="username" type="text" class="input-field" placeholder="User" required>
                    <input id="password" name="password" type="password" class="input-field" placeholder="Enter Password" required>
                    <input id="remember" name="remember" type="checkbox" class="check-box"><span>Remember Password</span>
                    <button type="submit" class="submit-btn">Log in</button>
                    <br>
                    <button type="button" class="submit-btn" onclick="back()">Back</button>
                </form>

                <form id="register" class="input-group" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">  <!--post- kogato shte wkarwam information v database // get- kogato slaga information-->
                    <div class="type">
                        <input id="username" name="username" type="text" class="input-field" placeholder="User" required>
                        <input id="email" name="email" type="email" class="input-field" placeholder="Email" required>
                        <span class="error"><?php echo $email_error;?></span>
                        <input id="password" name="password" type="password" class="input-field" placeholder="Enter Password" required>
                    </div>

                    <div class="subbnt">
                        <button type="submit" class="submit-btn">Register</button>
                        <br>
                        <button type="button" class="submit-btn" onclick="back()">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="login.js"></script>
</body>

</html>