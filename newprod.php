<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/product.css">
        <script type="text/javascript" src="/js/login.js"></script>

        <?php
            require "global.php";
            global $con;

            $header = ""; // ще им дадем стойност
            $btn = "";
            // take the parameters form the url address and if there is no parameter we set it null
            $token = isset($_GET['token']) ? $_GET['token'] : null;

            // работим с token-и
            // if it is token, ако е различно от нула
            if($token!=null)
            {
                //selecting the product with the given id (token)
                $sql = "select * from products where `id`= '$token'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_row($res);
                $header = "<p style='left: 30%!important' class='toggle-btn'>Edit product</p>";
                $btn = "<br><button type='submit' class='submit-btn' >Edit</button>";
            }
            else // ако е нула съответно ще се добави нов продукт
            {
                $header = "<p class='toggle-btn'>Add new product</p>";
                $btn = "<br><button type='submit' class='submit-btn' >Add new</button>";
            }

            //executing HTTP POST method
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                //take parameters from the POST method and in the double-quouts we type input name
                $img = $_POST["img"];
                $name = $_POST["name"];
                $price = $_POST["price"];
                $currency = $_POST["currency"];
                $desc = $_POST["desc"];
                $update = $_POST["ran"];

                // if there is no id we insert
                if($update==null) // ако няма да има update или ако няма id ще се добави нов продукт в базата данни
                {
                    $sql = "insert into `products` (`img`,`name`,`price`,`currency`,`desc`) value ('$img', '$name', '$price', '$currency', '$desc');";
                    $res = mysqli_query($con, $sql);
                }
                else
                { // if there is an id we update
                    $sql = "update `products` set `img`='$img', `name`='$name', `price`='$price', `currency`='$currency', `desc`='$desc' where `id`='$update';";
                    $res = mysqli_query($con, $sql);
                    header('Location: newprod.php?token='.$update); // казваме, че след token-на ще следва номера id
                }
            }
        ?>

    </head>
    <body>
        <div class="hero">
            <div class="box">
                <div class="form-box">
                    <div class="button-box">
                        <div id="btn"></div>
                        <?php echo $header; ?> <!--извикваме $header, който вече има стойността на бутон-->
                    </div>

                    <form id="newpost" class="input-group" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <!--С "if($token!=null) echo $row[1]" казваме, че ако token е различно от нула, ще се update-ва и следователно ще има възможността да се попълнят съответните колкони в базата данни-->
                        <input id="img" name="img" type="text" class="input-field" placeholder="img" required value="<?php if($token!=null) echo $row[1]?>">
                        <input id="name" name="name" type="text" class="input-field" placeholder="Title" required value="<?php if($token!=null) echo $row[2]?>">
                        <input id="price" name="price" type="text" class="input-field" placeholder="Price" required value="<?php if($token!=null) echo $row[3]?>">
                        <input id="currency" name="currency" type="text" class="input-field" placeholder="Currency" required value="<?php if($token!=null) echo $row[4]?>">
                        <input id="desc" name="desc" type="text" class="input-field" placeholder="Desc" required value="<?php if($token!=null) echo $row[5]?>">
                        
                        <input id="ran" name="ran" type="text" class="input-field" placeholder="Ran" style="display:none;" value="<?php echo $token ?>"> 
                        <!-- if there is an id we populate the inputs with information and we set ran with product id-->                    
                        <br>
                        <?php echo $btn;?>
                        <br>
                        <button type="button" class="submit-btn" onclick="back()">Back</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

