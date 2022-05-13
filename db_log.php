<?php
$con=mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');

$username = $_POST["username"];
$password = $_POST["password"];
$password = hash("sha256", $password);


// SELECT * FROM `user` WHERE username = $username AND password=$password;
$get_user = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";

$res = mysqli_query($con, $get_user);
$result = mysqli_fetch_array($res);

if($result) {
	if(isset($_POST["remember"]) && $_POST["remember"] == 1)
	    setcookie("login", "1", time() + 60);// second on page time 
    else {
	    setcookie("login", "1");
    }
    header("Location: index.php");
}

?>