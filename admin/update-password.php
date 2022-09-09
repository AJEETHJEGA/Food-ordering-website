<?php  include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>
        <?php 
            if(isset($_GET["id"]))
            {
                $id=$_GET["id"];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl">
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Enter old password">
                </td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="Enter new password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Reenter new password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Change password" class="btn-secondary">
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
        $currentpassword=md5($_POST["current_password"]);
        $newpassword=md5($_POST["new_password"]);
        $confirmpassword=md5($_POST["confirm_password"]);
        
        $sql= "SELECT * FROM `table-admin` WHERE id=$id AND password='$currentpassword'";

        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
           // $res=$result->num_rows;
           // if($res==1)
        
           // echo "user found";
           if($newpassword==$confirmpassword)
           {
               // echo "password match";
               $sql2="UPDATE `table-admin` SET 
                    password='$newpassword' WHERE id=$id
               ";
               $result2=$conn->query($sql2);
               if($result2==true)
               {
                $_SESSION['pwd_change']="<div class='success'>Password changed successfully</div>";
                header("location:".$siteurl."admin/manage-admin.php");
               }
               else
               {
                $_SESSION['pwd_change']="<div class='error'>Failed to change Password</div>";
                header("location:".$siteurl."admin/manage-admin.php");
               }
           }
           else
           {
                $_SESSION['pwd_not_match']="<div class='error'>Password did not match</div>";
                header("location:".$siteurl."admin/manage-admin.php");
           }
            }
            
             else
            {
               $_SESSION['user_not_found']="<div class='error'>User not found</div>";
              header("location:".$siteurl."admin/manage-admin.php");
            }
        
    }
?>

<?php include("partials/footer.php");?>