<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERBODY</title>
    <link rel="stylesheet" href="style.css"> <!-- adding css file -->
   
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
        if (isset($_COOKIE["login"]) && $_COOKIE["login"] == "1") {
            // dropdown menu
            /*<div class="dropdown">
                <button class="dropbtn">Profile</button>
                <div class="dropdown-content">
                    <a href="profile.php" onclick="toggleMenu();">Profile</a>
                    <a href="logout.php" onclick="toggleMenu();">Logout</a>
                </div>
            </div>
            */
            echo "<div class=\"dropdown\"><li><a class=\"dropbtn\">Profile</a><div class=\"dropdown-content\"><a href=\"profile.php\" onclick=\"toggleMenu();\">Account details</a><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></div></li></div>";
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
        <h2 class="titleText">Our <span>P</span>roducts</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
    </div>
    <div class="content">
        <div class="box">
            <div class="imgBox">
                <img src="img/Fennel_3.jpg">
            </div>
            <div class="text">
                <h3>Lavander Soaps</h3>
                <p class="price">$19.99</p>
                <div class="information">
                    <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
                </div>
                <p><button>Learn more</button></p>
            </div>
            
        </div>

        <div class="box">
            <div class="imgBox">
                <img src="img/Fennel_3.jpg">
            </div>
            <div class="text">
                <h3>Honey Soaps</h3>
                <p class="price">$19.99</p>
                <div class="information">
                    <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
                </div>
                <p><button>Learn more</button></p>
            </div>
        </div>

        <div class="box">
            <div class="imgBox">
                <img src="img/Fennel_3.jpg">
            </div>
            <div class="text">
                <h3>Fannel Soaps</h3>
                <p class="price">$19.99</p>
                <div class="information">
                    <p>Some text about the jeans. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
                </div>
                <p><button>Learn more</button></p>
            </div>
        </div>
    <!--
        <div class="box">
            <div class="imgBox">
                <img src="img/Fennel_3.jpg">
            </div>
            <div class="text">
                <h3>Actived cardon Soaps</h3>
            </div>
        </div>
    -->
    </div>

    <div class="title">
        <a href="#" class="btn">View All</a>
    </div>
</section>

<section class="contact" id="contact">
    <div class="title">
        <h2 class="titleText"><span>C</span>ontact Us</h2>
    </div>
    <!-- <form action="https://formsubmit.co/loloio.dim@gmail.com" method="post"> -->
    <div class="contactForm">
        <h3>Send Message</h3>
        <div class="inputBox">
            <input type="text" placeholder="Name">
        </div>

        <div class="inputBox">
            <input type="text" placeholder="Your Email">
        </div>

        <div class="inputBox">
            <textarea placeholder="Message"></textarea>
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

<script type="text/javascript" src="app.js"></script>
</body>

</html>