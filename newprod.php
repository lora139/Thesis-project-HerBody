<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
require "global.php";
global $con;

// take the parameters form the url address and if there is no parameter we set it null
$token = isset($_GET['token']) ? $_GET['token'] : null;

// if it is token
if($token!=null){
    //selecting the product with the given id (token)
    $sql = "select * from products where `id`= '$token'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
}

//executing HTTP POST method
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //take parameters from the POST method and in the double-quouts we type input name
    $img = $_POST["img"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $currency = $_POST["currency"];
    $desc = $_POST["desc"];
    $update = $_POST["ran"];

    // if there is no id we insert
    if($update==null){
        $sql = "insert into `products` (`img`,`name`,`price`,`currency`,`desc`) value ('$img', '$name', '$price', '$currency', '$desc');";
        $res = mysqli_query($con, $sql);
    }else{ // if there is an id we update
        $sql = "update `products` set `img`='$img', `name`='$name', `price`='$price', `currency`='$currency', `desc`='$desc' where `id`='$update';";
        $res = mysqli_query($con, $sql);
        header('Location: newprod.php?token='.$update);
    }
}
?>

</head>
<body>
    <form id="newpost" class="input-group-newpost" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input id="img" name="img" type="text" class="input-field" placeholder="img" required value="<?php if($token!=null) echo $row[1]?>">
                    <input id="name" name="name" type="text" class="input-field" placeholder="Title" required value="<?php if($token!=null) echo $row[2]?>">
                    <input id="price" name="price" type="text" class="input-field" placeholder="Price" required value="<?php if($token!=null) echo $row[3]?>">
                    <input id="currency" name="currency" type="text" class="input-field" placeholder="Currency" required value="<?php if($token!=null) echo $row[4]?>">
                    <input id="desc" name="desc" type="text" class="input-field" placeholder="Desc" required value="<?php if($token!=null) echo $row[5]?>">
                    <input id="ran" name="ran" type="text" class="input-field" placeholder="Ran" style="display:none;" value="<?php echo $token ?>"> 
                    <!-- if there is an id we populate the inputs with information and we set ran with product id-->
                    <button type="submit" class="submit-btn">Add new</button>
    </form>
</body>
</html>

