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
                        global $con; // използва глобалната променлиза $con

                        $sql = "SELECT o.orderid, o.clientname, o.email, o.phone, o.addr1, GROUP_CONCAT(p.`name`,':',c.qty SEPARATOR ', ') AS products FROM `order` o 
                        JOIN cart_order c ON c.oid = o.orderid
                        JOIN products p ON c.pid = p.id
                        group by o.orderid"; //заявка обединяваща данните от две таблици products and order
                        $res = mysqli_query($con, $sql);
                        if ($res) 
                        { // ако зяваката е осъществена, то тогава се изобразява таблицата с данните, до която има достп единствено администраторът
                            echo "<table><tr><th>Users id</th><th>Clients name</th><th>Email</th><th>Phone number</th><th>Address</th><th>Ordered products</th></tr>";                           
                            
                            while ($row = mysqli_fetch_row($res)) 
                            {
                                //информацията, която се взима от базата данни и се записва в полетата на таблицата щом някой е направил заявака за продукт
                                echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
                            }  
                            echo "</table>";
                        }
                    }
                    profile(); //извикване на метода
                ?>
                    <button type="button" class="btn" onclick="back()">Back</button>
            </div>
        </center>
    </body>
</html>