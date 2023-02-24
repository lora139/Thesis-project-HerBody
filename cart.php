<?php
require "global.php";

function add_to_cart($pid, $qty, $relative) {
    global $con;
    $username = $_COOKIE["login"];
    
    // check if alr exists in cart
    $res = mysqli_query($con, "SELECT * FROM `cart_item` WHERE pid = '$pid';");


    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_row($res);
        if ($relative) $qty += $row[3];
        else $qty = $row[3];
        $res = mysqli_query($con, "UPDATE `cart_item` SET qty = '$qty' WHERE pid = '$pid';");
    } else {
        $res = mysqli_query($con, "INSERT INTO `cart_item`(`uid`,`pid`,`qty`) VALUES('$username',$pid, $qty);");
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
    $res = mysqli_query($con, "SELECT c.qty, p.`img`, p.`name`, p.`price`, p.`currency` FROM `cart_item` c JOIN `products` p  ON p.id = c.pid WHERE c.uid = '$uid';");

    return $res;
}


?>