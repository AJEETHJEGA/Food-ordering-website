<?php

include("./config/constants.php");

if(isset($_GET["id"]) && isset($_GET["image_name"]))
{
    $id=$_GET["id"];
    $image_name=$_GET["image_name"];

    //check the image is available or not and delete only if available
    if($image_name!="")
    {
        //image is available
        //get the image path
        $path="../images/food/".$image_name;
        //remove the file from folder
        $remove=unlink($path);
        //check whether the image is removed or not
        if($remove==false)
        {
            //failed to remove
            $_SESSION["upload"]="<div class='error'>Failed to remove the image</div>";
            header("location:".$siteurl."admin/manage-food.php");
            die();
        } 
    }
    $sql="DELETE FROM `table-food` WHERE id=$id";
    $result=$conn->query($sql);

    if($result)
    {
        //food deleted
        $_SESSION["delete"]="<div class='success'>Food deleted succesfully</div>";
        header("location:".$siteurl."admin/manage-food.php");
    }
    else
    {
        //failed to delete food
        $_SESSION["delete"]="<div class='error'>Failed to delete food</div>";
        header("location:".$siteurl."admin/manage-food.php");
    }
}
else
{
    //redirect to manage food page
    $_SESSION["unauthorized"]="<div class='error'>Unauthorized access</div>";
    header("location:".$siteurl."admin/manage-food.php");

}

?>