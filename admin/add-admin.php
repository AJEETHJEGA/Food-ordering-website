<?php include("partials/menu.php")?>

<div class="main-content">
      <div class="wrapper">
        <h1>Add Admin </h1>
        <br>
        <?php 
            if(isset($_SESSION["add"]))
            {
                echo $_SESSION["add"];
                unset($_SESSION["add"]);
            }
        ?>
        <br>
        <form action="" method="POST">
            <table class="tbl">
                <tr>
                    <td>Full Name:</td>
                    <td> <input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                
                <tr>
                    <td>User Name:</td>
                    <td> <input type="text" name="username" placeholder="Enter your username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td> <input type="password" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                     </td>
                </tr>
            </table>
        </form>
      </div>
</div>      

<?php include("partials/footer.php")?>

<?php
   //insert the value in database 

   if(isset($_POST["submit"]))
   { 
    //Get the data from form
        $fullname=$_POST["full_name"];
        $username=$_POST["username"];
        $password=md5($_POST["password"]);

     //sql query to insert the data into database  
     $sql= "INSERT INTO `table-admin` SET
             full_name='$fullname',
             username='$username',
             password='$password'
             " ;
    $res=$conn->query($sql);
    if($res==TRUE)
    {
        //echo "data inserted";
        //create session to display message
        $_SESSION["add"] = "Admin added successfully";
        //redirect page to manage admin
        header("location:".$siteurl."admin/manage-admin.php"); 
    }
    else{
        //echo "failed";
         //create session to display message
         $_SESSION["add"] = "failed to add admin";
         //redirect page to add admin
         header("location:".$siteurl."admin/add-admin.php"); 
    }
   }
   die();
  

?>