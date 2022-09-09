<?php include("partials-frontend/menu.php");?>

    <?php
    
        //check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //get the id and details
            $food_id=$_GET["food_id"];

            $sql="SELECT * FROM `table-food` WHERE id=$food_id";
            $result=$conn->query($sql);
            if($result->num_rows==1)
            {
                //food available
                while($row=$result->fetch_assoc())
                {
                    $title=$row["title"];
                    $price=$row["price"];
                    $image_name=$row["image_name"];
                }
            } 
            else
            {
                //food not available
                header("location:".$siteurl."");
            }
        }
        else
        {
            //redirect to homepage
            header("location:".$siteurl."");
        }
    
    ?>
    <!-- Food Search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method=POST class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price">RS.<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ajeeth jega" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9443xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@ajeeth.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City,phone number" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                //check whether the sumit button is clicked or not
                if(isset($_POST['submit']))
                {
            
                    //get all the details from the form
                    $food=$_POST["food"];
                    $price=$_POST["price"];
                    $qty=$_POST["qty"];

                    $total=$price * $qty;

                    $order_date=date("Y-m-d h:i:s");
                    $status="ordered";
                    $customer_name=$_POST["full-name"];
                    $customer_contact=$_POST["contact"];
                    $customer_email=$_POST["email"];
                    $customer_address=$_POST["address"];

                    $sql2="INSERT INTO `table-order` SET
                            food='$food',
                            price=$price,
                            qty=$qty,
                            total=$total,
                            order_date='$order_date',
                            status='$status',
                            customer_name='$customer_name',
                            customer_contact='$customer_contact',
                            customer_email='$customer_email',
                            customer_address='$customer_address'
                    ";
                    
                    $result2=$conn->query($sql2);
                    if($result2)
                    {
                        //order saved successfully
                        $_SESSION["order"]="<div class='success text-center'>Food ordered successfully..</div>";
                        header("location:".$siteurl."");
                    }
                    else
                    {
                        //failed to save order
                        $_SESSION["order"]="<div class='error text-center'>Failed to order food </div>";
                        header("location:".$siteurl."");
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php include("partials-frontend/footer.php");?>