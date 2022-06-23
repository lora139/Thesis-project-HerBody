<!--JUST FOR FLEX: I AM LEVEL C1 IN ENGLISH-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERBODY</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- adding css file -->
   
</head>
<body>
<header>
    <a href="#" class="logo">Herbody<span>.</span></a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="#banner" onclick="toggleMenu();">Home</a></li>
        <li><a href="#about" onclick="toggleMenu();">About</a></li>
        <li><a href="#product" onclick="toggleMenu();">Products</a></li>
        <!--<li><a href="#testemonials">Testemonials</a></li> -->
        <li><a href="#contact" onclick="toggleMenu();">Contact</a></li>
        
        <?php
        require "global.php";

        global $con;
        /* if we are logged in instead of displaying a link to the login page, display a dropdown menu for the client */
        if (isset($_COOKIE["login"])) {
            // dropdown menu
            /*<div class="dropdown">
                <button class="dropbtn">Profile</button>
                <div class="dropdown-content">
                    <a href="profile.php" onclick="toggleMenu();">Profile</a>
                    <a href="logout.php" onclick="toggleMenu();">Logout</a>
                </div>
            </div>
            */
            $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($res);
            
            if($row[0] == 1){
               echo "<div class=\"dropdown\"><li><a class=\"dropbtn\">Profile</a><div class=\"dropdown-content\"><a href=\"profile.php\" onclick=\"toggleMenu();\">Client accounts</a><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></div></li></div>";
            }else{
               echo "<div class=\"dropdown\"><li><a class=\"dropbtn\">Profile</a><div class=\"dropdown-content\"><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></div></li></div>";
            }
        } else {
            echo "<li><a href=\"login.php\" onclick=\"toggleMenu();\">Log in</a></li>";
        }
        ?>
        
    </ul>
</header>
<section class="banner" id="banner">
    <div class="content">
        <h2>Always choose good</h2>
        <p>Handmade soaps with products from nature</p>
        <a href="#product" class="btn">Products</a>
    </div>
</section>
<!-- <div class ="parallax"></div> -->
<section class="about" id="about">
    <div class="row">
        <div class="col50">
            <h2 class="titleText"><span>A</span>bout Us</h2>
            <p>
            <br> Lorem Ipsum is simply dummy
            text of the printing and typesetting industry. Lorem Ipsum has been
            the industry's standard dummy text ever since the 1500s, when an
            unknown printer took a galley of type and scrambled it to make a 
            type specimen book.<br><br>Lorem Ipsum is simply dummy
            text of the printing and typesetting industry. Lorem Ipsum has been
            the industry's standard dummy text ever since the 1500s, when an
            unknown printer took a galley of type and scrambled it to make a 
            type specimen book.Lorem Ipsum is simply dummy
            text of the printing and typesetting industry. Lorem Ipsum has been
            the industry's standard dummy text ever since the 1500s, when an
            unknown printer took a galley of type and scrambled it to make a 
            type specimen book.
            inter took a galley of type and scrambled it to make a 
            type specimen book.Lorem Ipsum is simply dummy
            text of the printing and typesetting industry. Lorem Ipsum has been
            the industry's standard dummy text ever since the 1500s, when an
            unknown printer took a galley of type and scrambled it to make a 
            type specimen book.
            </p>
        </div>
        
        <div class="col50">
            <div class="box">
            <div class="imgBox">
                <img src="img/Honey_1.JPG">
            </div>
        </div>
    </div>
</div>
</section>

<section class="product" id="product">
    <div class="title">
        <h2 class="titleText"><span>P</span>roducts</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
    </div>
    <div class="slider">
        <div class="content">
            <?php
            require "global.php";
            /* get products */
            function get_products() {
                global $con;
                /* create an array*/
                $prod = [];
                $n = 0;
                /* select all the products which we import form the DB */
                $sql = "SELECT * FROM `products` ORDER BY id";
                /* return the result */        
                $res = mysqli_query($con, $sql);
                /* if it is successful, it puts all the product into an array*/
                if ($res) {
                    $n = mysqli_num_rows($res);
                    while ($row = mysqli_fetch_row($res)) {
                        $prod[] = $row;
                    }
                    /* free result from memory */
                    mysqli_free_result($res);
                } else return;  //returns nothing

                /*generate html for products page*/
                for ($i = 0; $i < $n; ++$i) {
                    /* special case when we reach the final product card */
                    if ($i == $n - 1) {
                        echo "<div class='box'><div class='imgBox'><img src='".$prod[$i][1]."'></div><div class='text'><h3>".$prod[$i][2]."</h3><p class='price'>".$prod[$i][4]."$ ".$prod[$i][3]."</p><div class='information'><p>".$prod[$i][5]."</p></div><p><button>Learn more</button></p></div></div>";    
                        echo "</div>";
                        break;
                    }
                    /* close a div on each third product card, except on the first one */
                    if ($i % 3 == 0 && $i != 0) echo "</div>";
                    /* start a div for the next three product cards */
                    if ($i % 3 == 0) echo "<div class='triple-box'>";
                    /* write html code for product card */
                    echo "<div class='box'><div class='imgBox'><img src='".$prod[$i][1]."'></div><div class='text'><h3>".$prod[$i][2]."</h3><p class='price'>".$prod[$i][4]."$ ".$prod[$i][3]."</p><div class='information'><p>".$prod[$i][5]."</p></div>";
                    if (isset($_COOKIE["login"]) && $_COOKIE["login"] == "1") {
                        echo "<p><button onclick=\"location.href='/product.php?id=".$prod[$i][0]."';\">Learn more</button></p></div></div>";
                    } else {
                        echo "<p><button onclick=\"location.href='/login.php';\">Learn more</button></p></div></div>";
                    }
                }
            }
            get_products();
            ?>
            
        </div>
        <center>
            <button class="btn" onclick="slider_shift(-1)">&#10094;</button>
            <button class="btn" onclick="slider_shift(1)">&#10095;</button>
        </center>
    </div>

   
</section>

<section class="contact" id="contact">
    <div class="title">
        <h2 class="titleText"><span>C</span>ontact Us</h2>
    </div>
    <form action="https://formsubmit.co/loloio.dim@gmail.com" method="post">
    <div class="contactForm">
        <h3>Send Message</h3>
        <div class="inputBox">
            <input name="name" type="text" placeholder="Name">
        </div>

        <div class="inputBox">
            <input name="email" type="text" placeholder="Your Email">
        </div>

        <div class="inputBox">
            <textarea name="message" placeholder="Message"></textarea>
        </div>

        <div class="inputBox">
            <input type="submit" value="Send">
        </div>
    </div>
    </form>
</section>

<div class="copyrightText">
    <p>Copyright © 2022 <a href="#">Herbody</a>. All Right Reserved</p>
</div>

<script type="text/javascript" src="/js/app.js"></script>
</body>

</html>