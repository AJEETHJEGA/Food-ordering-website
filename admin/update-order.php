<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <br>

        <?php
            //check id is set or not
            if(isset($_GET["id"]))
            {
                $id=$_GET["id"];

                $sql="SELECT * FROM `table-order` WHERE id=$id";
                $result=$conn->query($sql);
                if($result->num_rows==1)
                {
                    //details available
                    while($row=$result->fetch_assoc())
                    {
                        $food=$row["food"];
                        $price=$row["price"];
                        $qty=$row["qty"];
                        $status=$row["status"];
                        $customer_name=$row["customer_name"];
                        $customer_contact=$row["customer_contact"];
                        $customer_email=$row["customer_email"];
                        $customer_address=$row["customer_address"];
                    }
                }
                else
                {
                    //details not available
                    header("location:".$siteurl."admin/manage-order.php");
                }
            }
            else
            {
                //redirect to manage order
                header("location:".$siteurl."admin/manage-order.php");
            }


        ?>

        <form action="" method="POST">

        <table class="tbl2">
            <tr>
                <td>Food Name :</td>
                <td><b><?php echo $food;?></b></td>
            </tr>

            <tr>
                <td>Price :</td>
                <td><b>RS.<?php echo $price;?></b></td>
            </tr>

            <tr>
                <td>Qty :</td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty;?>">
                </td>
            </tr>

            <tr>
                <td>Status :</td>
                <td>
                    <select name="status" >
                        <option <?php if($status=="Ordered"){ echo "selected";}?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){ echo "selected";}?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){ echo "selected";}?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){ echo "selected";}?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Customer Name :</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                </td>
            </tr>

            <tr>
                <td>Customer Contact :</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                </td>
            </tr>

            <tr>
                <td>Customer Email :</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                </td>
            </tr>

            <tr>
                <td>Customer Address :</td>
                <td>
                    <textarea  name="customer_address" cols="30" row="5" ><?php echo $customer_address;?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php
        
            if(isset($_POST["submit"]))
            {
                //echo 'clicked';
                $id=$_POST["id"];
                $price=$_POST["price"];
                $qty=$_POST["qty"];

                $total=$price * $qty;

                $status=$_POST["status"];
                $customer_name=$_POST["customer_name"];
                $customer_contact=$_POST["customer_contact"];
                $customer_email=$_POST["customer_email"];
                $customer_address=$_POST["customer_address"];

                $sql2="UPDATE `table-order` SET
                        qty=$qty,
                        total=$total,
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                        WHERE id=$id
                ";
                 $result2=$conn->query($sql2);
                 if($result2)
                 {
                     //order saved successfully
                     $_SESSION["update"]="<div class='success'>Order updated successfully..</div>";
                     header("location:".$siteurl."admin/manage-order.php");
                 }
                 else
                 {
                     //failed to save order
                     $_SESSION["update"]="<div class='error'>Failed to update order</div>";
                     header("location:".$siteurl."admin/manage-order.php");
                 }
            }
        
        ?>
    </div>

</div>

<?php include("partials/footer.php")?>