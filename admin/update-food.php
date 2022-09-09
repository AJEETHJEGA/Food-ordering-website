<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>

        <?php
        if(isset($_GET["id"]))
        {
            $id=$_GET["id"];
            $sql="SELECT *FROM `table-food` WHERE id=$id";

            $result=$conn->query($sql);
            if($result->num_rows==1)
            {
                while($row=$result->fetch_assoc())
                {
                    $title=$row["title"];
                    $description=$row["description"];
                    $price=$row["price"];
                    $current_image=$row["image_name"];
                    $current_category=$row["category_id"];
                    $featured=$row["featured"];
                    $active=$row["active"];

                }
            }
            else
            {
                $_SESSION["no-food-found"]="<div class='error'>Food not found</div>";
                header("location:".$siteurl."admin/manage-food.php");
            }
        }
        else
        {
            header("location:".$siteurl."admin/manage-food.php");
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
                    <td>Description :</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" ><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image :</td>
                    <td>
                       <?php
                        if($current_image=="")
                        {
                            //image not available
                            echo "<div class='error'>Image not available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?php echo $siteurl;?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title;?>" width='100px'>
                            <?php
                        }
                       ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql2="SELECT * FROM `table-category` WHERE active='Yes'";
                                $result2=$conn->query($sql2);

                                if($result2->num_rows>0)
                                {
                                    while($row2=$result2->fetch_assoc())
                                    {
                                        //category available
                                        $category_title=$row2["title"];
                                        $category_id=$row2["id"];

                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                            <option <?php if($current_category==$category_id){echo "selected";}?> value='<?php echo $category_id;?>'><?php echo $category_title;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                     //category not available
                                    echo "<option value='0'>Category not available</option>";
                                }
                            ?>
                            <option value="0">test</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"<?php if($featured=="Yes"){ echo "checked";}?>>Yes
                        <input type="radio" name="featured" value="No"<?php if($featured=="No"){ echo "checked";}?>>No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes"<?php if($active=="Yes"){ echo "checked";}?>>Yes
                        <input type="radio" name="active" value="No"<?php if($active=="No"){ echo "checked";}?>>No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary" >

                    </td>
                </tr>
            </table>
        </form>  
        <?php
        
        if(isset($_POST["submit"]))
        {
            $id=$_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            //upload the image if selected
            // check whether the upload utto clicked or not
            if(isset($_FILES['image']['name']))
            {
                //upload button clicked
                $image_name=$_FILES['image']['name'];
                //check the file available or not
                if($image_name!="")
                {
                    //image available
                    //rename the image
                    $exe=end(explode('.',$image_name));
                    $image_name="food-name".rand(0000,9999).'.'.$exe;

                    //source and destination path
                    $src=$_FILES['image']['tmp_name'];
                    $dest="../images/food/".$image_name;

                    //upload the image
                    $upload=move_uploaded_file($src,$dest);
                    //check whether the image is uploaded or not
                    if($upload==false)
                    {
                        //failed to upload
                        $_SESSION['upload']="<div class='error'>Failed to upload new image</div>";
                        header("location:".$siteurl."admin/manage-food.php");
                        die();

                    }
                    //remove the current image
                    if($current_image!="")
                    {
                        //current image available
                        //remove the image
                        $remove_path="../images/food/".$current_image;
                        $remove=unlink($remove_path);
                        if($remove==false)
                        {
                            //failed to remove
                            $_SESSION["failed"]="<div class='error'>Failed to remove current image</div>";
                            header("location:".$siteurl."admin/manage-food.php");
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
            
            //upload the food in database
            $sql3="UPDATE `table-food` SET
                            title='$title',
                            description='$description',
                            price=$price,
                            image_name='$image_name',
                            category_id='$category',
                            featured='$featured',
                            active='$active'
                            WHERE id='$id'
                 ";

                 $result3=$conn->query($sql3);
                 if($result3)
                 {
                    $_SESSION["update"]="<div class='success'>Food updated successfully</div>";
                    header("location:".$siteurl."admin/manage-food.php");
                 }
                 else
                 {
                    $_SESSION["update"]="<div class='error'>Failed to updated food</div>";
                    header("location:".$siteurl."admin/manage-food.php");
                 }
        }

        ?>
    </div>
</div>
<?php include("partials/footer.php")?>