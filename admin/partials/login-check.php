<?php

if(!isset($_SESSION["user"]))
{
    $_SESSION["no-login"]="<div class='error'>Please login to access admin panel</div>";

    header("location:".$siteurl."admin/login.php");
}

?>