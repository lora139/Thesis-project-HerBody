<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/vcart.css"> <!-- добавяне на css file -->
    </head>
    <body>
        <?php
            require "cart.php"; //използва методите от файл cart.php

            $username = $_COOKIE["login"]; //запазва влезлия потребител чрез cookie-та
            $products = get_cart($username); //взима количката на съответния потредител
            $total = 0.0;

            foreach ($products as $k => $v) 
            {
                echo "<div class='vcontent'><div class='vtriple-box'><div class='vbox'><div class='vimgBox'><img src=".$v['img']."></div><div class='vtext'><p>".$v['name']."<br>".($v['price'] * $v['qty'])." $".$v['currency']. "<br>".$v['qty']."</p></div></div></div></div>";
                //показва снимката на продукта и неговата цена, като взима информацията от базата данни
                $total += $v["qty"] * $v["price"];
                //$total показва общата цена на всички събрани продукти и съответно тяхната бройка
            }
            echo "<div class='num'><p>Total price is: ". $total."</p></div>"; //отпечатва стойността на всички продукти, центата, която трявба да плати купувачът
        ?>
        <div class="pos-btn">
            <a href="pay.php">
                <br>
                <button class="vbtn">Pay now!</button>
            </a>
            <br>
            <br>
            <a href="index.php">
                <button class="vbtn">Back to the main page!</button>
            </a>
        </div> 
    </body>
</html>