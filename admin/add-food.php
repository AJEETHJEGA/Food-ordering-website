<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Foods</h1>
        <br> <br>

        <?php
        
            if(isset($_SESSION["upload"]))
            {
                echo $_SESSION["upload"];
                unset($_SESSION["upload"]);
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl2">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">

                        <?php
                        //create sql query to display active categories from database
                        $sql="SELECT *FROM `table-category` WHERE active='Yes'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0)
                        {
                            while($row=$result->fetch_assoc())
                            {
                                //get the details of category
                                $id=$row["id"];
                                $title=$row["title"];
                                ?>
                                <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                <?php
                            }
                        }
                        else
                        {
                            //no category found
                            ?>
                            <option value="0">No category found</option>
                            <?php
                        }
                        ?>
                                                      
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary" >

                    </td>
                </tr>
            </table>
        </form>

        <?php
        
            if(isset($_POST["submit"]))
            {
                //echo "clicked";
                $title=$_POST["title"];
                $description=$_POST["description"];
                $price=$_POST["price"];
                $category=$_POST["category"];

                //check whether radio butto of featured and active clicked or not
                if(isset($_POST["featured"]))
                {
                    $featured=$_POST["featured"];
                }
                else
                {
                    $featured="No"; //set default value
                }

                if(isset($_POST["active"]))
                {
                    $active=$_POST["active"];
                }
                else
                {
                    $active="No";
                }

                //upload the image if selected
                //check whether the select image is clicked or not and upload the image if selected
                if(isset($_FILES["image"]["name"]))
                {
                    //get the details of the selected image
                    $image_name=$_FILES["image"]["name"];
                    //check whether image is selected or not and upload only if selected
                    if($image_name!="")
                    {
                        //image is selected
                        //rename the image 
                        //get extension
                        $exe=end(explode('.',$image_name));
                        //create ew name for image
                        $image_name="Food-name-".rand(0000,9999).".".$exe;
                        //upload the image
                        //get sourcepath(current location) and destination path
                        $src=$_FILES['image']['tmp_name'];
                        $desc="../images/food/".$image_name; 

                        $upload=move_uploaded_file($src,$desc);
                        if($upload==false)
                        {
                            //failed to upload the image
                            //redirect to addfood page with error message
                            $_SESSION["upload"]="<div class='error'>Failed to upload the image</div>";
                            header("location:".$siteurl."admin/add-food.php");
                            die();
                        }
                    }

                }
                else
                {
                    //setting default as blank
                    $image_name="";
                }

                //create query to insert addfood
                $sql2="INSERT INTO `table-food` SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                ";
                $result2=$conn->query($sql2);
                if($result2)
                {
                    $_SESSION["add"]="<div class='success'>Food added successfully.</div>";
                    header("location:".$siteurl."admin/manage-food.php");
                }
                else
                {
                    $_SESSION["add"]="<div class='error'>Failed to add food.</div>";
                    header("location:".$siteurl."admin/manage-food.php");
                }
            }

        ?>
    </div>
</div>

<?php include("partials/footer.php")?>