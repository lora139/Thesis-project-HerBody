<?php
    setcookie("login","",time()-1);//for delete the cookie /destroy the cookie 
    header("location:index.php") //връща към главната страница, без да има сесия като потребител 
?>
