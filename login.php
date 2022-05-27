<!DOCTYPE html>
<html lang="en">

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
                    <p class="toggle-btn">Log in</p>
                </div>

                <form id="login" class="input-group" method="POST" action="auth.php"> <!--???nz fr -->
                    <input id="username" name="username" type="text" class="input-field" placeholder="User" required>
                    <input id="password" name="password" type="password" class="input-field" placeholder="Enter Password" required>
                    <input id="remember" name="remember" type="checkbox" class="check-box"><span>Remember Password</span>
                    <input type="hidden" name="auth_type" value="login">

                    <button type="submit" class="submit-btn">Log in :></button>
                    <br>
                    <button type="button" class="submit-btn" onclick="register_ref()">Don't have an account?</button>
                    <br>
                    <button type="button" class="submit-btn" onclick="back()">Back</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="login.js"></script>
</body>

</html>