<?php

$con=mysqli_connect('localhost:3306','root','3Bzye017818*','loginsystem');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$password = hash("sha256", $password);

$create_datetime = date("Y-m-d H:i:s");

$sql = "INSERT INTO `user`(id, username, email, password, create_datetime) VALUES (0,'$username', '$email', '$password', '$create_datetime')";

$rs=mysqli_query($con, $sql);

if($rs) {
	echo "done";
	header("Location: login.html");
}
?>