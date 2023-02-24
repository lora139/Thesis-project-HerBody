<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/vcart.css"> <!-- добавяне на css file -->
    </head>
    <body>
        <?php
            require "cart.php";
            $username = $_COOKIE["login"];
            $products = get_cart($username);
            $total = 0.0;
            foreach ($products as $k => $v) {
                echo "<div class='vcontent'><div class='vtriple-box'><div class='vbox'><div class='vimgBox'><img src=".$v['img']."></div><div class='vtext'><p>".$v['name']."<br>".($v['price'] * $v['qty'])." $".$v['currency']. "<br> Amount ".$v['qty']."</p></div></div></div></div>";
                $total += $v["qty"] * $v["price"];
                
            }
            echo "<div class='num'>". $total."</div>";
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