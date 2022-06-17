<?php

//require "error.php";

require "global.php";

//$con = mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');
//$email_error = "ERROR STRING LOL";

function register($username, $email, $password) {
    global $con;
    $create_datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO `user`(username, email, password, create_datetime, is_admin) VALUES ('$username', '$email', '$password', '$create_datetime', 0)";
    $rs=mysqli_query($con, $sql);

    if($rs) {
	    header("Location: login.php");
    }
}

function login($username, $password) {
    global $con;

    // SELECT * FROM `user` WHERE username = $username AND password=$password;
    $sql = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($con, $sql);

    if(mysqli_num_rows($res) > 0) {
	    if(isset($_POST["remember"]) && $_POST["remember"] == 1)
            setcookie("login", "1", time() + 60);// second on page time 
        else setcookie("login", "1");
        //echo $_COOKIE["login"];
        header("Location: index.php");
    } else header("Location: login.php");
}

/* always runs */

if ($_SERVER["REQUEST_METHOD"] != "POST") exit();

$username = $_POST["username"]; // add isset
$password = hash("sha256", $_POST["password"]);

switch ($_POST["auth_type"]) {
    case "login":
        login($username, $password);
        break;
    case "register":
        $email = $_POST["email"];
        register($username, $email, $password);
        break;
    default: exit();
}

?>