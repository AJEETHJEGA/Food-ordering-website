<?php include("partials/menu.php")?>

 <!--Main section starts-->
 <div class="main-content">
      <div class="wrapper2">
        <h1>Manage Order</h1>
    
        <br>
        <br>
        
        <?php
            if(isset($_SESSION["update"]))
            {
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }
        
        ?>
        <br>
        <br>
        <table class="table-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Customer Address</th>
                <th>Action</th>
            </tr>

            <?php
            
                $sql="SELECT * FROM `table-order` ORDER BY id DESC";
                $result=$conn->query($sql);
                $sn=1;
                if($result->num_rows>0)
                {
                    //order available
                    while($row=$result->fetch_assoc())
                    {
                        $id=$row["id"];
                        $food=$row["food"];
                        $price=$row["price"];
                        $qty=$row["qty"];
                        $total=$row["total"];
                        $order_date=$row["order_date"];
                        $status=$row["status"];
                        $customer_name=$row["customer_name"];
                        $customer_contact=$row["customer_contact"];
                        $customer_email=$row["customer_email"];
                        $customer_address=$row["customer_address"];
                        ?>

                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>

                            <td>
                                <?php 
                                    if($status=="ordered")
                                    {
                                        echo "<lable>$status</lable>";
                                    }
                                    elseif($status=="On Delivery")
                                    {
                                        echo "<lable style='color:orange;'>$status</lable>";
                                    }
                                    elseif($status=="Delivered")
                                    {
                                        echo "<lable style='color:green;'>$status</lable>";
                                    }
                                    elseif($status=="Cancelled")
                                    {
                                        echo "<lable style='color:red;'>$status</lable>";
                                    }
                                
                                ?>
                            </td>

                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $customer_contact;?></td>
                            <td><?php echo $customer_email;?></td>
                            <td><?php echo $customer_address;?></td>
                            <td>
                            <a href="<?php echo $siteurl;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary"> Update Order</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    //order not available
                    echo "<tr><td colspan='12' class='error'>Order not available</td></tr>";
                }
            
            ?>
            
        </table>
        
      </div>
   </div>
   <!--Main section ends-->

<?php include("partials/footer.php")?>