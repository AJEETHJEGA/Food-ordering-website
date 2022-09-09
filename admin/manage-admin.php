<?php include("partials/menu.php")?>
  
   <!--Main section starts-->
   <div class="main-content">
      <div class="wrapper">
        <h1>Manage Admin </h1>
        <br>
        <?php
          
            if(isset($_SESSION["add"]))
            {
                echo $_SESSION["add"];
                unset($_SESSION["add"]);
            }
            if(isset($_SESSION["delete"]))
            {
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }
            if(isset($_SESSION["update"]))
            {
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }
            if(isset($_SESSION["user_not_found"]))
            {
                echo $_SESSION["user_not_found"];
                unset($_SESSION["user_not_found"]);
            }
            if(isset($_SESSION["pwd_not_match"]))
            {
                echo $_SESSION["pwd_not_match"];
                unset($_SESSION["pwd_not_match"]);
            }
            if(isset($_SESSION["pwd_change"]))
            {
                echo $_SESSION["pwd_change"];
                unset($_SESSION["pwd_change"]);
            }

        ?>
        <br>
        <br>
        <!--button to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <br>
        
        <table class="table-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>

            <?php

                $sql="SELECT * FROM `table-admin`";

                $result=$conn->query($sql);
                $sn=1;
                if($result->num_rows>0)
                {
                    while ($row=$result->fetch_assoc())
                    {

                        $id=$row["id"];
                        $fullname=$row["full_name"];
                        $username=$row["username"];
                    ?>
                
                        <tr>
                           <td><?php echo $sn++;?></td>
                           <td><?php echo $fullname;?></td>
                           <td><?php echo $username;?></td>
                           <td>
                            <a href="<?php echo "$siteurl";?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                           <a href="<?php echo "$siteurl";?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary"> Update Admin</a>
                           <a href="<?php echo "$siteurl";?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                           </td>
                         </tr>
                         <?php
                    }
                }
                else
                {
                    echo "failed to fetch";
                }

            ?>


        </table>
    
      </div>
   </div>
   <!--Main section ends-->
          
   <?php include("partials/footer.php")?>