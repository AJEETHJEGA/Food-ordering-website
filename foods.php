<?php include("partials-frontend/menu.php");?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?echo $siteurl;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!--Food Search Section Ends Here -->



    <!--Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            $sql="SELECT *FROM `table-food` WHERE active='Yes'";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                //food available
                while($row=$result->fetch_assoc())
                {
                    $id=$row["id"]; 
                    $title=$row["title"];
                    $price=$row["price"];
                    $description=$row["description"];
                    $image_name=$row["image_name"];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                
                                    if($image_name=="")
                                    {
                                        //display message
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>

                                        <img src="<?php echo $siteurl;?>images/food/<?php echo $image_name;?>" alt="briyani" class="img-responsive img-curve">

                                        <?php
                                    }

                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">RS.<?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo $siteurl;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                }

            }
        
            else
            {
                //food not available
                echo "<div class='error'>Food not available</div>";
            }

            ?>
 
            <div class="clearfix"></div> 

        </div>

    </section>
    <!--Food Menu Section Ends Here -->

    <?php include("partials-frontend/footer.php");?>