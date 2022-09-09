<?php include("partials/menu.php");?>

<div class="main-content">
      <div class="wrapper">
        <h1>Update Admin </h1>
        <br>
        <br>
        <?php
        $id=$_GET["id"];

        $sql="SELECT * FROM `table-admin` WHERE id=$id ";

        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            while($row=$result->fetch_assoc()){

                $fullname=$row["full_name"];
                $username=$row["username"];

            }
        }
         else
         {
           header("location:".$siteurl."admin/manage-admin.php");
         }
        

        ?>
        <form action="" method="POST">
            <table class="tbl">
                <tr>
                    <td>Full Name:</td>
                    <td> <input type="text" name="full_name" value="<?php echo $fullname;?>"></td>
                </tr>
                
                <tr>
                    <td>User Name:</td>
                    <td> <input type="text" name="username" value="<?php echo $username;?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                     </td>
                </tr>
            </table>
        </form>
      </div>
</div>       

<?php

    if(isset($_POST["submit"]))
    {
      $id=$_POST["id"];
      $fullname=$_POST["full_name"];
      $username=$_POST["username"];

      $sql="UPDATE `table-admin` SET full_name='$fullname', username='$username' WHERE id='$id' ";
      $result=$conn->query($sql);

      if($result==true)
      {
        $_SESSION["update"]="<div class='success'>Admin Updated Succsccfullly.</div>";

        header("location:".$siteurl."/admin/manage-admin.php");
      }
      else
      {
        $_SESSION["update"]="<div class='error'>Failed to Delete Admin.</div>";

        header("location:".$siteurl."/admin/manage-admin.php");
      }
      
    }

?>

<?php include("partials/footer.php")?>