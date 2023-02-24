<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/login.css">
        <title>Payment</title>
    </head>

    <?php
            require "global.php";
            global $con;
            if($_SERVER["REQUEST_METHOD"]=="POST") 
            {
                //take parameters from the POST method and in the double-quouts we type input name
                $name = $_POST["username"];
                $email = $_POST["email"];
                $telephone = $_POST["telephone"];
                $text1 = $_POST["text1"];
                $text2 = $_POST["text2"];
                /* SQL query to search for user with given username and password */
                $sql = "insert into `order` (clientname, email, phone, addr1, addr2) VALUES ('$name','$email', '$telephone', '$text1', '$text2');";
                $res = mysqli_query($con, $sql); /* execute query */
                $last_id = mysqli_insert_id($con);
                $uid = $_COOKIE["login"];

                $cart = mysqli_query($con, "SELECT c.id,c.qty,p.id , p.`img`, p.`name`, p.`price`, p.`currency` FROM `cart_item` c JOIN `products` p  ON p.id = c.pid WHERE c.uid = '$uid';");
                
                foreach ($cart as $k => $v) {
                    $sql2 = "insert into `cart_order` (oid, uid, pid, qty) VALUES (".$last_id.",'".$uid."',".$v['id'].",".$v['qty'].")";
                    $res2 = mysqli_query($con,$sql2);

                    $sql3 = "Delete from `cart_item` where uid = '".$uid."'";
                    $res3 = mysqli_query($con, $sql3);
                }

            }
    ?>

    <body>
        <div class="hero">
            <div class="box">
                <div class="form-box">
                    <div class="button-box">
                        <div id="btn"></div>
                        <p class="toggle-btn">Pay now!</p>
                    </div>

                    <form id="order" class="input-group-reg" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">  <!--post- kogato shte wkarwam information v database // get- kogato slaga information-->  
                        <input id="username" name="username" type="text" class="input-field" placeholder="Your name" required>
                        <input id="email" name="email" type="email" class="input-field" placeholder="Email" required>
                        <input id="telephone" name="telephone" type="tel" class="input-field" placeholder="Phone number" required>
                        <input id="address" name="text1" type="text" class="input-field" placeholder="Address 1" required>
                        <input id="address" name="text2" type="text" class="input-field" placeholder="Address 2">

                        <span id="value_error"></span>
                        <br>
                        <button type="submit" class="submit-btn">Submit</button>
                        <br>
                        <button type="button" class="submit-btn" onclick="back()">Back to the main page</button>
                        <br>
                        <button type="button" class="submit-btn" onclick="pay()">Back to the cart</button>
                        
                        
                    </form>
                </div>    
            </div>
        </div>

        <script type="text/javascript" src="/js/login.js"></script>
    </body>
</html>
