<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
       
        <?php

            if(isset($_SESSION["add"]))
            {
                echo $_SESSION["add"];
                unset($_SESSION["add"]);
            }

            if(isset($_SESSION["upload"]))
            {
                echo $_SESSION["upload"];
                unset($_SESSION["upload"]);
            }
        ?>
        
        <br>
        <br>
        <!--add category form starts-->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl2">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                
                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name="image">
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
                    <td>Active : </td>

                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>

        <!--add category form ends-->

        <?php
        
            if(isset($_POST["submit"]))
            {
                $title=$_POST["title"];

                //print_r($_FILES["image"]);
               // die();
               if(isset($_FILES["image"]["name"]))
                {
                    
                    $image_name=$_FILES["image"]["name"];
                    //upload the image only if the image is selected 
                   if($image_name!="")
                    {
                     //auto rename the image
                     $ext=end(explode(".",$image_name));
                     $image_name="food_category".rand(000,999).".".$ext;


                     $source_path=$_FILES["image"]["tmp_name"];
                     $destination_path="../images/category/".$image_name;
                     $upload=move_uploaded_file($source_path,$destination_path);

                     if($upload==false)
                     {
                        $_SESSION["upload"]="<div class='error'>Failed to upload the image</div>";
                        header("location:".$siteurl."admin/addcategory.php");
                        die();
                     }
                    }
            }
                else
                {
                    //don't upload image and set image_name as blank
                    $image_name="";
                }
                 
                //for radio input to check whether te button clicked or not
                if(isset($_POST["featured"]))
                {
                    $featured=$_POST["featured"];
                }
                else
                {
                    $featured="No";
                 }

               if(isset($_POST["active"]))
               {
                    $active=$_POST["active"];
               }
               else
               {
                   $active="No";
               }

                 $sql=("INSERT INTO `table-category` SET
                                 title='$title',
                                 image_name='$image_name',
                                 featured='$featured',
                                  active='$active'
                      ");
                 $result=$conn->query($sql);

                if($result)
                  {
                  // echo "success";
                   $_SESSION["add"]="<div class='success'>Category Added Successfully<div> ";
                   header("location:".$siteurl."admin/manage-category.php");
                  }

               else
               {
                //echo "fail";
                  $_SESSION["add"]="<div class='error'>Failed to Add Category<div> ";
                  header("location:".$siteurl."admin/addcategory.php");
               }
               
            }
            

        ?>

     </div>

</div>


<?php include('partials/footer.php')?>



