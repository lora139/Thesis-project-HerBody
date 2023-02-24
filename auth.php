<?php
/* User authentication routines */

require "global.php";


/* Add a new user to database. */
function register($username, $email, $password) {
    global $con;
    
    $create_datetime = date("Y-m-d H:i:s"); /* time of creation */
    /* SQL query to insert data */
    $sql = "INSERT INTO `user`(username, email, password, create_datetime, is_admin) VALUES ('$username', '$email', '$password', '$create_datetime', 0)";
    $rs=mysqli_query($con, $sql); /* execute query */

    /* if successful, redirect to login page */
    if($rs) {
        header("Location: login.php");
    }
}
/* Authenticate an existing user. */
function login($username, $password) {
    global $con;

    /* SQL query to search for user with given username and password */
    $sql = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($con, $sql); /* execute query */

    /* if there are results enable login cookie */
    if(mysqli_num_rows($res) > 0) {
        /* if user wants to be remembered between visits set this cookie */
	    if(isset($_POST["remember"]) && $_POST["remember"] == 1)
            setcookie("login", $username, time() + 60);// second on page time
        else setcookie("login", $username);
        /* redirect to main page */
        header("Location: index.php");
    } else {
        $usernameExist = "SELECT * FROM `user` WHERE username = '$username'";
        $result = mysqli_query($con, $usernameExist);

        if(mysqli_num_rows($result) == 0) {
        setcookie("Error","username", time() + 1);
        }
        else {
        setcookie("Error","password", time() + 1);
        }
         header("Location: login.php");
     } /* if no users are found redirect to login page again */
}

/* automatically start login or register procedures based on form fields */

/* if the file is just being included in another stop here */
if ($_SERVER["REQUEST_METHOD"] != "POST") exit();

/* get username and password from form fields */
$username = $_POST["username"]; // add isset

if (!isset($username)) exit(); //if the userfield is empty, it will exit
if(!isset($_POST["password"])) exit(); //if the password field is empty, it will exit

$password = hash("sha256", $_POST["password"]); /* hash the password */

/* are we logging in or registering? */
switch ($_POST["auth_type"]) {
    case "login":
        login($username, $password);
        break;
    case "register":
        /* get email here because login forms don't have an email field */
        $email = $_POST["email"];
        if(!isset( $_POST["email"])) exit(); //if the email field is empty, it will exit
        register($username, $email, $password);
        break;
    default: exit();
}

?>