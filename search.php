<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/search.css"> <!-- добавяне на css file -->
        <script type="text/javascript" src="/js/app.js"></script>
    </head>
    <body>
    <header>
            <a href="#" class="logo">Herbody<span>.</span></a> <!-- Логото -->
            <div class="menuToggle" onclick="toggleMenu();"></div>
            <ul class="navigation"> <!--Полето с навигацията и менютата-->
                <li><a href="index.php#banner" onclick="toggleMenu();">Home</a></li> <!--Home полето-->
                <li><a href="index.php#about" onclick="toggleMenu();">About</a></li> <!--About полето -->
                <li><a href="index.php#product" onclick="toggleMenu();">Products</a></li><!--Products полето-->
                <li><a href="index.php#contact" onclick="toggleMenu();">Contact</a></li><!--Contact полето-->
        
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
                                echo "<div class=\"dropdown\"><li><a href=\"logout.php\" onclick=\"toggleMenu();\">Logout</a></li></div>";
                                echo "<div class=\"dropdown\"><li><a href=\"viewcart.php\" onclick=\"toggleMenu();\" class=\"dropbtn\">View cart</a></li></div>";
                            }
                        } else {
                            echo "<li><a href=\"login.php\" onclick=\"toggleMenu();\">Log in</a></li>";
                        }
                    ?>
            </ul>
    </header>

        <?php
            require "global.php";
            require "cart.php";
            global $con;

            //collect the post of the script

            //check if the post is selected
            if(isset($_POST['search']))
            {
                $searchq = $_POST['search'];
                $pid = $_POST['pid'];
                $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
                if($pid != null) {
                    add_to_cart($pid, 1, true);
                    echo "pid: ".$pid;
                }else {
                    echo "none pid";
                }
                if($searchq == null || $searchq == "")
                {
                    echo "<div class='no-res'><p>There was no search results</p></div>";
                    echo "<br><button type='button' class='submit-btn' onclick=\"back();\">Back</button>";
                }
                else
                {
                    $query = mysqli_query($con,"SELECT * FROM `products` WHERE `name` LIKE '%$searchq%'");
                    $n = mysqli_num_rows($query);
                    
                    if ($n == 0) {
                        echo "<div class='no-res'><p>There was no search results</p></div>";
                        echo "<br><button type='button' class='submit-btn' onclick=\"back();\">Back</button>";
                        return;
                    }
                    foreach($query as $k => $row)
                    {
                        echo $row['id'];
                        $id = $row['id'];
                        $img = $row['img'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $currency = $row['currency'];
                        $desc = $row['desc'];
                        
                        echo "<div class='content'><div class='triple-box'><div class='box'><div class='imgBox'><img src=".$img."></div><div class='text'><h3>".$name."</h3><p class='price'>".$price." ".$currency."</p><div class='information'><p>".$desc."</p></div>";
                        
                        if(isset($_COOKIE["login"])){
                            $sql = "select is_admin from `user` where username = '". $_COOKIE["login"] . "'";
                            $res = mysqli_query($con, $sql);
                            $row1 = mysqli_fetch_row($res);

                            if($row1[0] != 1){
                                echo
                                "<p class='p1'>
                                    <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                        <input type='hidden' name='pid' id = 'pid' value='".$id."'>
                                        <input type='hidden' name='search' id = 'search' value='".$searchq."'>
                                        <button type='submit'>Add to cart</button>
                                    </form>
                                </p>";
                            }

                        } else {
                            echo "<p class='p1'><button onclick=\"location.href='/login.php';\">Buy now!</button></p>";
                        }
                        echo "</div></div></div></div>";
                    }
                
                }
            }
        ?>
    </body>
</html>