<?php

include("./config/constants.php");
//check whether the id and img value is set or not to prevent hacking

if(isset($_GET["id"]) AND isset($_GET["image_name"]))
{
    //echo 'get success';
    $id=$_GET["id"];
    $image_name=$_GET["image_name"];

    if($image_name!="")
    {
        //image is avalable .so remove it
        $path="../images/category/".$image_name;
        $remove=unlink($path);

        if($remove==false)
        {
            $_SESSION["remove"]="<div class='error'>Failed to remove category image</div>";
            header("location:".$siteurl."admin/manage-category.php");
            //stop the process
            die();
        }
    }
    $sql="DELETE FROM `table-category` WHERE id=$id";
    $result=$conn->query($sql);
    if($result)
    {
        $_SESSION["delete"]="<div class='success'>Category deleted successfully.</div>";
        header("location:".$siteurl."admin/manage-category.php");
    }
    else
    {
        $_SESSION["delete"]="<div class='error'>Failed to deleted category.</div>";
        header("location:".$siteurl."admin/manage-category.php");
    }
}
else
{
    header("location:".$siteurl."admin/manage-category.php");
}


?>