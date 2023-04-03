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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--използва се този линк за иконата на Инстаграм-->
        <script type="text/javascript" src="/js/app.js"></script> <!--JavaScript file-->
        <script>
            if (window.history.replaceState)
            {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </head>

        <?php
            require "cart.php";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") // ако има подобен пробукт дава стойност
            {
                $pid = $_POST["pid"];
                add_to_cart($pid, 1, true);
            }

        ?>
    <body>
        <header>
            <a href="#" class="logo">HerBody</a> <!-- Логото -->
            <div class="menuToggle" onclick="toggleMenu();"></div><!--тук ли трябва да е div-а-->
            <ul class="navigation"> <!--Полето с навигацията и менютата-->
                <li><a href="#banner" onclick="toggleMenu();">Home</a></li> <!--Home полето-->
                <li><a href="#about" onclick="toggleMenu();">About</a></li> <!--About полето -->
                <li><a href="#product" onclick="toggleMenu();">Products</a></li><!--Products полето-->
                <li><a href="#contact" onclick="toggleMenu();">Contact</a></li><!--Contact полето-->
        
                    <?php
                        require "global.php";
                        global $con;

                        /* if we are logged in instead of displaying a link to the login page, display the page for the client */
                        if (isset($_COOKIE["login"]))
                        {
                            $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'"; // select-ва потребителя и му задава куки
                            $res = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($res);

                            if($row[0] == 1) //ако потребителят е администратор
                            { 
                                echo "<li><a href=\"/newprod.php\">Add product</a></li>";
                                echo "<li><a href=\"profile.php\" onclick=\"toggleMenu();\">Client accounts</a></li>";
                                echo "<li><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></li>";
                            }
                            else //ако потребителят е клиент
                            { 
                                echo "<li><a href=\"viewcart.php\" onclick=\"toggleMenu();\">View cart</a></li>";
                                echo "<li><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></li>";
                                echo"<li><form method='post' action='search.php'><input  class='search' type='text' name='search' placeholder='Search products...'><input class='search_btn' type='submit' value='Search'></form></div></li></ul>";
                            }
                        }
                        else //ако потребителят е просто посетител в сайта
                        {
                            echo "<li><a href=\"login.php\" onclick=\"toggleMenu();\">Log in</a></li>";
                            echo"<li><form method='post' action='search.php'><input  class='search' type='text' name='search' placeholder='  Search products...'><input class='search_btn' type='submit' value='Search'></form></li></ul>";
                        }
                    ?>
        </header>

        <section class="banner" id="banner"> <!--първата секция от страницата - показва главното място, когато се влезе в нея-->
            <div class="content">
                <h2>Always choose good</h2>
                <p>Handmade soaps with products from nature</p>
                <a href="#product" class="btnp">Products</a>
            </div>
        </section>

        <section class="about" id="about"> <!--секцията показваща повече информация за фирмата-->
            <div class="row">
                <div class="col50">
                    <h2 class="titleText"><span>A</span>bout Us</h2>
                    <p>
                    <br>
                    The company was founded in 2020.
                    <br><br> 
                    The idea of our enterprise is to give people the opportunity 
                    to be as close as possible to natural fragrances and healing methods, 
                    without the use of chemical elements and additives to cosmetic products.
                    <br><br>
                    All the ingredients we use in our products are tailored to different 
                    needs of a person. 
                    <br><br> 
                    In each product, doTERRA essential oils are added, which, in addition 
                    to their soothing and healing effects, have strong aromas acquired from the essential oils of plants. 
                    <br><br>
                    Our aim is to show people that essential oils can help people not 
                    only in the form of extracts, but also incorporated into cosmetic products.
                    We are distinguished by our dedication to our cause and our personal attention to each individual.

                    </p>
                </div>

                <div class="col50">
                    <div class="box">
                        <div class="imgBox">
                            <img src="img/free1.jpg"> <!--снимката в дясно-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product" id="product"> <!--секцията с предлаганите продукти-->
            <div class="title">
                <h2 class="titleText"><span>P</span>roducts</h2>
                <p>Here you can see what we are offering:</p>
            </div>

            <div class="slider">
                <div class="content">
                    <?php
                        require "global.php";

                        /* get products */
                        function get_products()
                        {
                            global $con;
                            /* create an array*/
                            $prod = [];
                            $n = 0;
                            /* select all the products which we import form the DB */
                            $sql = "SELECT * FROM `products` ORDER BY id";
                            /* return the result */
                            $res = mysqli_query($con, $sql);
                            /* if it is successful, it puts all the product into an array*/
                            if ($res)
                            {
                                $n = mysqli_num_rows($res);
                                while ($row = mysqli_fetch_row($res))
                                {
                                    $prod[] = $row;
                                }
                                /* free result from memory */
                                mysqli_free_result($res);
                            }
                            else return;  //returns nothing
                                
                            $pages = $n / 3;
                            // go through all pages
                            for ($i = 0; $i < $pages; ++$i)
                            {
                                echo "<div class='triple-box'>";

                                for ($j = 3 * $i; $j < 3 * ($i + 1); ++$j)//разделя кутиите с продукти по 3 на ред
                                {
                                    if ($j > $n - 1) break;
                                    echo "<div class='box'><div class='imgBox'><img src='".$prod[$j][1]."'></div><div class='text'><h3>".$prod[$j][2]."</h3><p class='price'>".$prod[$j][3]." ".$prod[$j][4]."</p><div class='information'><p>".$prod[$j][5]."</p></div>";
                                    
                                    if(isset($_COOKIE["login"]))
                                    {
                                        $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'";
                                        $res = mysqli_query($con, $sql);
                                        $row = mysqli_fetch_row($res);

                                        if($row[0] == 1)
                                        {
                                            echo "<p><button onclick=\"location.href='/newprod.php?token=".$prod[$j][0]."';\">Edit</button></p>";
                                            echo "<p><button onclick=\"location.href='/deleteprod.php?token=".$prod[$j][0]."';\">Delete</button></p>";
                                        }
                                        else
                                        {
                                            echo 
                                            "<p class='p1'>
                                                <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                    <input type='hidden' name='pid' value='".$prod[$j][0]."'>
                                                    <button type='submit'>Add to cart</button>
                                                </form>
                                            </p>";
                                        }
                                    }
                                    else 
                                    {
                                        echo "<p class='p1'><button onclick=\"location.href='/login.php';\">Buy now!</button></p>";
                                    }
                                    echo "</div></div>";
                                }
                                echo "</div>";
                            }    
                        }
                        get_products();?>
                </div>
            
                <center>
                    <button class="btn" onclick="slider_shift(-1)">&#10094;</button>
                    <button class="btn" onclick="slider_shift(1)">&#10095;</button>
                </center>
            </div>
        </section>

        <section class="contact" id="contact"> <!--секцията позволяваща потребителите да се свързват с продавача-->
            <div class="title">
                <h2 class="titleText"><span>C</span>ontact Us</h2>
            </div>

            <form action="https://formsubmit.co/loloio.dim@gmail.com" method="post"> <!--използва се този сайт за изпращане на съобщенията от клиентите към търговеца-->
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
                <div class= "fot">
                    <fieldset>
                        <br>
                        <p>FOLLOW US OUT THERE</p>
                        <a href="https://www.instagram.com/photoshots1309" target="_blank" class="fa fa-instagram fa-2x"></a> <!--иконата на Инстаграм-->
                    </fieldset>
                </div>
            
        </footer>

        <div class="copyrightText">
            <h5>Copyright © 2022 <a href="#">HerBody</a>. All Right Reserved</h5>
        </div>
    </body>
</html>