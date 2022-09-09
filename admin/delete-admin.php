<?php

include("./config/constants.php");

$id = $_GET["id"];

$sql = "DELETE FROM `table-admin` WHERE id=$id";

$result = $conn->query($sql);

if($result==true)
{
    //echo "Admin deleted";
    $_SESSION["delete"] = "<div class='success'>Admin deleted successfully.</div>";
    header("location:".$siteurl."admin/manage-admin.php");
    
}
else
{
   // echo "Failed to delete admin";
   $_SESSION["delete"] = "<div class='error'>Failed to deleted admin.</div>";
   header("location:".$siteurl."admin/manage-admin.php");
   
}


?>