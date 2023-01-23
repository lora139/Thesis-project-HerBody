<!--JUST FOR FLEX: I AM LEVEL C1 IN ENGLISH-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HERBODY</title> <!-- Името на страница -->
        <link rel="stylesheet" href="css/style.css"> <!-- добавяне на css file -->
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </head>
        <?php
            require "cart.php";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pid = $_POST["pid"];
                add_to_cart($pid, 1, true);
            }

        ?>
    <body>
        <header>
            <a href="#" class="logo">Herbody<span>.</span></a> <!-- Логото -->
            <div class="menuToggle" onclick="toggleMenu();"></div><!--тук ли трябва да е div-а-->
            <ul class="navigation"> <!--Полето с навигацията и менютата-->
                <li><a href="#banner" onclick="toggleMenu();">Home</a></li> <!--Home полето-->
                <li><a href="#about" onclick="toggleMenu();">About</a></li> <!--About полето -->
                <li><a href="#product" onclick="toggleMenu();">Products</a></li><!--Products полето-->
                <li><a href="#contact" onclick="toggleMenu();">Contact</a></li><!--Contact полето-->
                    
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
                                echo "<li><a href=\"/newprod.php\">Add product</a></li>";
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
                                
                            $pages = $n / 3;
                            // go through all pages
                            for ($i = 0; $i < $pages; ++$i) {
                                echo "<div class='triple-box'>";
                                for ($j = 3 * $i; $j < 3 * ($i + 1); ++$j) {
                                    if ($j > $n - 1) break;
                                    echo "<div class='box'><div class='imgBox'><img src='".$prod[$j][1]."'></div><div class='text'><h3>".$prod[$j][2]."</h3><p class='price'>".$prod[$j][4]."$ ".$prod[$j][3]."</p><div class='information'><p>".$prod[$j][5]."</p></div>";
                                    
                                    if(isset($_COOKIE["login"])){
                                        $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'";
                                        $res = mysqli_query($con, $sql);
                                        $row = mysqli_fetch_row($res);

                                        echo 
                                        "<p>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <input type='hidden' name='pid' value='".$prod[$j][0]."'>
                                                <button type='submit'>Add to cart</button>
                                            </form>
                                        </p>";
                                        echo "<p><button onclick=\"location.href='/product.php?id=".$prod[$j][0]."';\">Learn more</button></p>";

                                        if($row[0] == 1){
                                            echo "<p><button onclick=\"location.href='/newprod.php?token=".$prod[$j][0]."';\">Edit</button></p>";
                                            echo "<p><button onclick=\"location.href='/deleteprod.php?token=".$prod[$j][0]."';\">Delete</button></p>";
                                        }
                                    } else {
                                        echo "<p><button onclick=\"location.href='/login.php';\">Learn more</button></p>";
                                    }
                                    echo "</div></div>";
                                }
                                echo "</div>";
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
                        <input name="email" type="email" placeholder="Your Email">
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


        <footer>
            <p>Author: Lora and Marin<br>
            <a>loloio.dim@gmail.com and m.l.bizov@gmail.com</a></p>
        </footer>

        <div class="copyrightText">
            <p>Copyright © 2022 <a href="#">Herbody</a>. All Right Reserved</p>
        </div>

        <script type="text/javascript" src="/js/app.js"></script>
        
    </body>

</html>