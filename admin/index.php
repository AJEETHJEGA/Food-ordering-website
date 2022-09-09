<?php include("partials/menu.php")?>
  
   <!--Main section starts-->
   <div class="main-content">
      <div class="wrapper">
        <h1>Dashboard</h1>
        <br>
        <?php

        if(isset($_SESSION["login"]))
                {
                    echo $_SESSION["login"];
                    unset($_SESSION["login"]);
                }

        ?>
        <br>
        <div class="column-4 text-center">

                <?php
                
                    $sql="SELECT * FROM `table-category`";
                    $result=$conn->query($sql);
                    $row=$result->num_rows;
                
                ?>
            <h1><?php echo $row;?></h1>
            <br>
            Categories
        </div>
        <div class="column-4 text-center">

            <?php
                
                $sql2="SELECT * FROM `table-food`";
                $result2=$conn->query($sql2);
                $row2=$result2->num_rows;
            
            ?>
            <h1><?php echo $row2;?></h1>
            <br>
            Foods
        </div>
        <div class="column-4 text-center">

             <?php
                
                $sql3="SELECT * FROM `table-order`";
                $result3=$conn->query($sql3);
                $row3=$result3->num_rows;
            
            ?>
            <h1><?php echo $row3;?></h1>
            <br>
            Total orders
        </div>
        <div class="column-4 text-center">

            <?php
            
                $sql4="SELECT SUM(total) AS Total FROM `table-order` WHERE status='Delivered'";
                $result4=$conn->query($sql4);
                $row4=$result4->fetch_assoc();

                $total_revenue=$row4["Total"];

            
            ?>
            <h1>RS.<?php echo $total_revenue;?></h1>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
      </div>
   </div>
   <!--Main section ends-->

<?php include("partials/footer.php")?>