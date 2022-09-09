<?php include("partials/menu.php")?>

 <!--Main section starts-->
 <div class="main-content">
      <div class="wrapper">
        <h1>Manage Foods</h1>
        <br>
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
          if(isset($_SESSION["delete"]))
            {
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }
          if(isset($_SESSION["unauthorized"]))
            {
                echo $_SESSION["unauthorized"];
                unset($_SESSION["unauthorized"]);
            }
          if(isset($_SESSION["failed"]))
            {
                echo $_SESSION["failed"];
                unset($_SESSION["failed"]);
            }
            if(isset($_SESSION["update"]))
            {
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }
         ?>
         <br>
         <br>
        <!--button to add admin-->
        <a href="<?php echo $siteurl;?>admin/add-food.php" class="btn-primary">Add Foods </a>
        <br>
        <br>
        <br>
        
        <table class="table-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql="SELECT * FROM `table-food`";
                $result=$conn->query($sql);
                $sn=1;
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
                        $id=$row["id"];
                        $title=$row["title"];
                        $price=$row["price"];
                        $image_name=$row["image_name"];
                        $featured=$row["featured"];
                        $active=$row["active"];
                        ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?> </td>
                            <td>RS.<?php echo $price;?></td>
                            <td>
                                <?php 
                                    //check image is available
                                    if($image_name=="")
                                    {
                                        //image not availale
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                    else
                                    {
                                        //image availale ,display it
                                        ?>
                                        <img src="<?php echo $siteurl;?>images/food/<?php echo $image_name;?>"width="80px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                            <a href="<?php echo $siteurl;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary"> Update Food</a>
                            <a href="<?php echo $siteurl;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Food</a>
                            </td>
                        </tr>


                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
                }
            ?>
            
            
        </table>
        
      </div>
   </div>
   <!--Main section ends-->

<?php include("partials/footer.php")?>