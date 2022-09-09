<?php include("partials-frontend/menu.php");?>

    <?php
    
        //check whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //category id is set and get the id
            $category_id=$_GET["category_id"];

            $sql="SELECT title FROM `table-category` WHERE id=$category_id";

            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            //get the title
            $category_title=$row['title'];
        }
        else
        {
            //category not passed
            //redirect to homepage
            header("location:".$siteurl."");
        }

    ?>
    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
                //create sql query to get foods based on category selected
                $sql2="SELECT * FROM `table-food` WHERE category_id=$category_id";
                $result2=$conn->query($sql2);
                if($result2->num_rows>0)
                {
                    //food is available
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
                    //food is not available
                    echo "<div class='error'>Food not available.</div>";
                }
            
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

 <?php include("partials-frontend/footer.php");?>