<?php include("partials/menu.php")?>

 <!--Main section starts-->
 <div class="main-content">
      <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <br>

        <?php
        if(isset($_SESSION["add"]))
            {
                echo $_SESSION["add"];
                unset($_SESSION["add"]);
            }

            if(isset($_SESSION["remove"]))
            {
                echo $_SESSION["remove"];
                unset($_SESSION["remove"]);
            }
            if(isset($_SESSION["delete"]))
            {
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }
            
            if(isset($_SESSION["update"]))
            {
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }
            if(isset($_SESSION["upload"]))
            {
                echo $_SESSION["upload"];
                unset($_SESSION["upload"]);
            }
            if(isset($_SESSION["failed-remove"]))
            {
                echo $_SESSION["failed-remove"];
                unset($_SESSION["failed-remove"]);
            }

        ?>
        <br>
        <br>
        <!--button to add admin-->
        <a href="<?php echo $siteurl;?>admin/addcategory.php"class="btn-primary">Add Category</a>
        <br>
        <br>
        <br>
        
        <table class="table-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

                $sql="SELECT * FROM `table-category`"; 
                
                $result=$conn->query($sql);
                $sn=1;
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
                        $id=$row["id"];
                        $title=$row["title"];
                        $image_name=$row["image_name"];
                        $featured=$row["featured"];
                        $active=$row["active"];
                        ?>

                    <tr>
                          <td><?php echo $sn++;?></td>
                          <td><?php echo $title;?></td>
                          <td>
                            <?php 
                            if($image_name!="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo $siteurl?>images/category/<?php echo $image_name;?>" width="100px">
                                <?php
                            }
                            else
                            {
                                //display the message
                                echo"<div class='error'> Image not added</div>";
                            }
                            ?>
                          </td>
                          <td><?php echo $featured;?></td>
                          <td><?php echo $active;?></td>
                          <td>
                            <a href="<?php echo $siteurl;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary"> Update Admin</a>
                            <a href="<?php echo $siteurl;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Admin</a>
                          </td>
                  </tr>

                        <?php
                    }
                }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>
                        <?php
                    }
                


            ?>

            
            
        </table>
        
    </div>
 </div>
 <!--Main section ends-->

<?php include("partials/footer.php")?>

