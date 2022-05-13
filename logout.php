
<?php

// if (isset($_COOKIE["login"])) {
//     unset($_COOKIE["login"]);
//     setcookie("login", null, -1, "/");
// }
setcookie("login","",time()-1);//for delete the cookie //destroy the cookie 
header("location:index.php")


?>
