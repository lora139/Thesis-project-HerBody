<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css"> <!-- adding css file -->
        <script type="text/javascript" src="/js/login.js"></script>
    </head>
    <body>
        <div class= "profile">
            <center>
                <div class="prof_box">
                    <div class= "prof_image" >
                        <img src="img/Honey_1.JPG">
                    </div>

                    <?php
                    require "global.php";

                    function profile() {
                        global $con;

                        $sql = "SELECT username, email, create_datetime FROM `user` WHERE username = '" . $_COOKIE["login"] . "'";
                        $res = mysqli_query($con, $sql);
                        if ($res) {
                            if (mysqli_num_rows($res) > 1) return;
                            $row = mysqli_fetch_row($res);

                            echo "<div class= \"details\">";
                            echo "<span>username: </span>" . $row[0];
                            echo "<br><br><span>email: </span>" . $row[1];
                            echo "</div>";
                        }
                    }
                    profile();
                    ?>
                    <button type="button" class="btn" onclick="back()">Back</button>
                </div>
            </center>
        </div>
    </body>
</html>