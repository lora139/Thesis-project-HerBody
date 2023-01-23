<?php
require "global.php";

function add_to_cart($pid, $qty, $relative) {
    global $con;
    $username = $_COOKIE["login"];
    
    // check if alr exists in cart
    $res = mysqli_query($con, "SELECT * FROM `cart` WHERE pid = '$pid';");


    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_row($res);
        if ($relative) $qty += $row[2];
        else $qty = $row[2];
        $res = mysqli_query($con, "UPDATE `cart` SET qty = '$qty' WHERE pid = '$pid';");
    } else {
        $res = mysqli_query($con, "INSERT INTO `cart`(`uid`,`pid`,`qty`) VALUES('$username',$pid, $qty);");
    }
}

function res_to_array($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function get_cart($uid) {
    global $con;
    $res = mysqli_query($con, "SELECT c.qty, p.`img`, p.`name`, p.`price`, p.`currency` FROM `cart` c JOIN `products` p  ON p.id = c.pid WHERE c.uid = '$uid';");

    return $res;
}


?>