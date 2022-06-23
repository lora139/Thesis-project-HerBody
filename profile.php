<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/accounts.css"> <!-- adding css file -->
        <script type="text/javascript" src="/js/login.js"></script>
    </head>
    <body>
        <center>
            <div class="detail">
                    <?php
                    require "global.php";

                    function profile() {
                        global $con;

                        $sql = "SELECT username, email, `password`, create_datetime FROM `user`";
                        $res = mysqli_query($con, $sql);
                        if ($res) {
                            echo "<table><tr><th>Username</th><th>Email</th><th>Password</th><th>Date of a creation</th></tr>";
                            while ($row = mysqli_fetch_row($res)) {
                                echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
                            }
                            echo "</table>";
                        }
                    }
                    profile();
                    ?>
                    <button type="button" class="btn" onclick="back()">Back</button>
            </div>
        </center>
    </body>
</html>