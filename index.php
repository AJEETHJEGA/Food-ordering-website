<?php include("partials-frontend/menu.php");?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<? echo $siteurl;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php

        if(isset($_SESSION['order']))
        {
           echo $_SESSION['order'];
           unset($_SESSION['order']);
        }

    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            
            $sql="SELECT *FROM `table-category` WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                //category available
                while($row=$result->fetch_assoc())
                {
                    $id=$row["id"];
                    $title=$row["title"];
                    $image_name=$row["image_name"];
                    ?>
                    <a href="<?php echo $siteurl;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
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

                                    <img src="<?php echo $siteurl;?>images/category/<?php echo $image_name;?>" alt="briyani" class="img-responsive img-curve">

                                    <?php
                                }
                            
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>



                    <?php
                }
            }
            else
            {
                    //category not available
                    echo "<div class='error'>Cadegory not added</div>";
            }
            
            ?>
            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            $sql2="SELECT *FROM `table-food` WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $result2=$conn->query($sql2);
            if($result2->num_rows>0)
            {
                //food available
                while($row2=$result2->fetch_assoc())
                {
                    $id=$row2["id"]; 
                    $title=$row2["title"];
                    $price=$row2["price"];
                    $description=$row2["description"];
                    $image_name=$row2["image_name"];
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

    <?php include("partials-frontend/footer.php")?>