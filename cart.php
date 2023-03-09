<?php
    require "global.php";

    function add_to_cart($pid, $qty, $relative)  // добавяне на продукти в количката
    {
        global $con;
        $username = $_COOKIE["login"];
        
        // check if alr exists in cart
        $res = mysqli_query($con, "SELECT * FROM `cart_item` WHERE pid = '$pid';"); //взима продуктите в cart_item по product id

        if (mysqli_num_rows($res) > 0) //ако номера на редовете е повече от 0
        {
            $row = mysqli_fetch_row($res); //Връща числов масив, който съответства на извлечения ред и премества указателя на вътрешните данни напред.
            if ($relative) $qty += $row[3];
            else $qty = $row[3];
            $res = mysqli_query($con, "UPDATE `cart_item` SET qty = '$qty' WHERE pid = '$pid';");
        }
        else
        {
            $res = mysqli_query($con, "INSERT INTO `cart_item`(`uid`,`pid`,`qty`) VALUES('$username',$pid, $qty);"); //в противен случай доавя елемент в базата данни
        }
    }

    function res_to_array($result) //обновява данните
    {
        $rows = array();
        while($row = $result->fetch_assoc()) //ако няма елементи ще възне празен масив
        { 
            $rows[] = $row;
        }
        return $rows;
    }

    function get_cart($uid) // взима количката обединяваща елементите и колоните от cart_item и products
    {
        global $con;
        $res = mysqli_query($con, "SELECT c.qty, p.`img`, p.`name`, p.`price`, p.`currency` FROM `cart_item` c JOIN `products` p  ON p.id = c.pid WHERE c.uid = '$uid';");

        return $res;
    }
?>