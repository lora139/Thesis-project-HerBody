<?php
$con = mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');

function register() {
    //$cont = mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');
    global $con;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = hash("sha256", $password);

    $create_datetime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `user`(id, username, email, password, create_datetime, is_admin) VALUES (0,'$username', '$email', '$password', '$create_datetime', 0)";

    $rs=mysqli_query($con, $sql);

    if($rs) {
	    echo "done";
	    header("Location: login.php");
    }
}

function login() {
    //$cont = mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');
    global $con;

    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = hash("sha256", $password);

    // SELECT * FROM `user` WHERE username = $username AND password=$password;
    $get_user = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($con, $get_user);

    if($res) {
	    if(isset($_POST["remember"]) && $_POST["remember"] == 1)
	        setcookie("login", "1", time() + 60);// second on page time 
        else {
	        setcookie("login", "1");
        }
        header("Location: index.php");
    }
}

function check_existing() {
    
}




?>