<?php include("partials-frontend/menu.php");?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
            
                 //get the search keyword
                // $search=$_POST['search'];
                $search=$conn->real_escape_string($_POST['search']);
            
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //sql query to get all foods based on search keyword
                $sql="SELECT * FROM `table-food` WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
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
                                            //image not available
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
                                    <h4><?PHP echo $title;?></h4>
                                    <p class="food-price">RS.<?php echo $price;?></p>
                                    <p class="food-detail">
                                        <?php echo $description;?>
                                    </p>
                                    <br>
                            
                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

    <?php include("partials-frontend/footer.php");?>