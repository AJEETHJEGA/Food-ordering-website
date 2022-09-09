<?php include("partials-frontend/menu.php");?>


    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //display all the categories that are active
                $sql="SELECT *FROM `table-category` WHERE active='Yes'";
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
                                            //image not available
                                            echo "<div class='error'>image not found</div>";
                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                                <img src="<?php $siteurl;?>images/category/<?php echo $image_name;?>" alt="briyani" class="img-responsive img-curve">
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
                        echo "<div class='error'>Cadegory not found</div>";
                }
            
            ?>
        
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include("partials-frontend/footer.php");?>