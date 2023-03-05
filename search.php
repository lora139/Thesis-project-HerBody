<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/search.css"> <!-- добавяне на css file -->
        <script type="text/javascript" src="/js/app.js"></script> <!-- добавяне на js file -->
    </head>
    <body>
    <header>
            <a href="#" class="logo">HerBody</a> <!-- Логото -->
            <div class="menuToggle" onclick="toggleMenu();"></div>
            <ul class="navigation"> <!--Полето с навигацията и менютата-->
                <li><a href="index.php#banner" onclick="toggleMenu();">Home</a></li> <!--Home полето-->
                <li><a href="index.php#about" onclick="toggleMenu();">About</a></li> <!--About полето -->
                <li><a href="index.php#product" onclick="toggleMenu();">Products</a></li><!--Products полето-->
                <li><a href="index.php#contact" onclick="toggleMenu();">Contact</a></li><!--Contact полето-->
        
                    <?php
                        require "global.php"; // използва променливата във файла global.php
                        global $con; //съответно променливата е $con

                        /* if we are logged in instead of displaying a link to the login page, display the page for the client */
                        if (isset($_COOKIE["login"]))
                        {
                            $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'"; //проверчва дали потребителя е  login-нат
                            $res = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($res);

                            if($row[0] != 1) // ако потребителят не е админ се появяват възможносттите за Logout и View cart в навигацията
                            {
                                echo "<div class=\"dropdown\"><li><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></li></div>";
                                echo "<div class=\"dropdown\"><li><a href=\"viewcart.php\" onclick=\"toggleMenu();\" class=\"dropbtn\">View cart</a></li></div>";
                            }
                        }
                        else //ако не е потребител или администратор, тоест е просто посетител, излиза възможността за Log in
                        {
                            echo "<li><a href=\"login.php\" onclick=\"toggleMenu();\">Log in</a></li>";
                        }
                    ?>
            </ul>
    </header>

        <?php
            require "global.php"; 
            require "cart.php"; // използва методите от cart.php
            global $con;

            //collect the post of the script

            //check if the post is selected
            if(isset($_POST['search']))
            {
                $searchq = $_POST['search'];
                $pid = 0;

                if(isset($_POST['pid'])) //проверява pid product id дали съвпада
                {
                    $pid = $_POST['pid'];
                    add_to_cart($pid, 1, true);
                }

                $searchq = preg_replace("#[^0-9a-z]#i","",$searchq); //търси по всички смиволи, малки и главни букви и т.н.

                if($searchq == null || $searchq == "") // ако не е написан продукт, който се търси, излиза съобщението "There was no search results"
                {
                    echo "<div class='no-res'><p>There was no search results</p></div>";
                    echo "<br><button type='button' class='submit-btn' onclick=\"back();\">Back</button>";
                }
                else
                {
                    $query = mysqli_query($con,"SELECT * FROM `products` WHERE `name` LIKE '%$searchq%'"); //проверява али търсеният продукт или символ съвпада с този в Базата Данни
                    $n = mysqli_num_rows($query);
                    
                    if ($n == 0) // ако няма подобен продукт, изписва "There was no search results"
                    {
                        echo "<div class='no-res'><p>There was no search results</p></div>";
                        echo "<br><button type='button' class='submit-btn' onclick=\"back();\">Back</button>";
                        return;
                    }

                    // визуализиране на търсеният продукт като намерен артикул
                    foreach($query as $k => $row)
                    {
                        $id = $row['id'];
                        $img = $row['img'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $currency = $row['currency'];
                        $desc = $row['desc'];
                        
                        //начина на визуализиране
                        echo "<div class='content'><div class='triple-box'><div class='box'><div class='imgBox'><img src=".$img."></div><div class='text'><h3>".$name."</h3><p class='price'>".$price." ".$currency."</p><div class='information'><p>".$desc."</p></div>";
                        
                        if(isset($_COOKIE["login"]))
                        {
                            $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'";
                            $res = mysqli_query($con, $sql);
                            $row1 = mysqli_fetch_row($res);

                            if($row1[0] != 1) //ако потребителят е регистриран и не е администратор има възможността да добави търсеният продукт към кошницата
                            {
                                echo
                                "<p class='p1'>
                                    <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                        <input type='hidden' name='pid' id = 'pid' value='".$id."'>
                                        <input type='hidden' name='search' id = 'search' value='".$searchq."'>
                                        <button type='submit'>Add to cart</button>
                                    </form>
                                </p>";
                            }
                        }
                        else  // в противен случай, ако е само посетител ще му покаже бутона "Buy now!", който ще го заведе до login страницата
                        {
                            echo "<p class='p1'><button onclick=\"location.href='/login.php';\">Buy now!</button></p>";
                        }
                        echo "</div></div></div></div>";
                    }
                }
            }
        ?>
    </body>
</html>