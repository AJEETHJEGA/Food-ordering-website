<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        if(isset($_GET["id"]))
        {
            $id=$_GET["id"];
            $sql="SELECT *FROM `table-category` WHERE id=$id";

            $result=$conn->query($sql);
            if($result->num_rows==1)
            {
                while($res=$result->fetch_assoc())
                {
                    $title=$res["title"];
                    $current_image=$res["image_name"];
                    $featured=$res["featured"];
                    $active=$res["active"];

                }
            }
            else
            {
                $_SESSION["no-category-found"]="<div class='error'>Category not found</div>";
                header("location:".$siteurl."admin/manage-category.php");
            }
        }
        else
        {
            header("location:".$siteurl."admin/manage-category.php");
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl2">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image :</td>
                    <td>
                        <?php
                            if($current_image!="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo $siteurl;?>images/category/<?php echo $current_image ;?>" >
                                <?php
                            }
                            else
                            {
                                //display the message
                                echo "<div class='error'>Image not added.<?div>";
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>New Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured"<?php if($featured=="Yes") echo "checked";?> value="Yes" >Yes
                         <input type="radio" name="featured"<?php if($featured=="No") echo "checked";?> value="No" >No
                    </td>
                </tr>
                
                <tr>
                    <td>Active : </td>
                    <td>
                        <input type="radio" name="active"<?php if($active=="Yes") echo 'checked';?>  value="Yes" >Yes
                        <input type="radio" name="active"<?php if($active=="No") echo 'checked';?> value="No" >No
                    </td>
                </tr>
                
                <tr>
                    <td >
                        <input type="hidden" name="current_image"  value="<?php echo $current_image?>">
                        <input type="hidden" name="id"  value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>

        <?php
        
             if(isset($_POST["submit"]))
             {
                //echo 'click';
                $id=$_POST["id"];
                $title=$_POST["title"];
                $current_image=$_POST["current_image"];
                $featured=$_POST["featured"];
                $active=$_POST["active"];

                //update new image if selected
                //check whether image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name=$_FILES['image']['name'];
                    //check whether image is available
                    if($image_name!="")
                       {
                            //image available
                            //upload new image
                            //auto rename the image
                            $ext=end(explode(".",$image_name));
                            $image_name="food_category".rand(000,999).".".$ext;
       
       
                            $source_path=$_FILES["image"]["tmp_name"];
                            $destination_path="../images/category/".$image_name;
                            $upload=move_uploaded_file($source_path,$destination_path);
       
                            if($upload==false)
                            {
                               $_SESSION["upload"]="<div class='error'>Failed to upload the image</div>";
                               header("location:".$siteurl."admin/manage-category.php");
                               die();
                            }

                            //remove current image if availale
                            if($current_image!="")
                            {
                                 $remove_path="../images/category/$current_image";
                                 $remove=unlink($remove_path);

                                 //check whether the image is removed or not
                                 //if failed then stop the process and display message
                                 if($remove==false)
                                 {
                                    //failed to remove
                                      $_SESSION["failed-remove"]="<div class='error'>Failed to remove current image</div>";
                                     header("location:".$siteurl."admin/manage-category.php");
                                     die();
                                 } 
                            }
                        }
                    else
                     {
                        $image_name=$current_image;
                     }

                }
                else
                {
                    $image_name=$current_image;
                }

                //update the database
                $sql2="UPDATE `table-category` SET
                            title='$title',
                            featured='$featured',
                            image_name='$image_name',
                            active='$active'
                            WHERE id='$id'
                 ";

                 $result2=$conn->query($sql2);
                 if($result2)
                 {
                    $_SESSION["update"]="<div class='success'>Category updated successfully</div>";
                    header("location:".$siteurl."admin/manage-category.php");
                 }
                 else
                 {
                    $_SESSION["update"]="<div class='error'>Failed to updated category</div>";
                    header("location:".$siteurl."admin/manage-category.php");
                 }

             }

        ?>
    </div>
</div>
<?php include("partials/footer.php")?>