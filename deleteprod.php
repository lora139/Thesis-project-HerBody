<?php
    require "global.php";
    global $con;
    // take the parameters form the url address
    $token = isset($_GET['token']) ? $_GET['token'] : null;

    //deleting the item with id = token (url parameter)
    $sql = "Delete from products where `id`= '$token'";
    $res = mysqli_query($con, $sql);

    //main page
    header('Location: index.php#product')
?>