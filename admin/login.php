<?php include("./config/constants.php");?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant Website-login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login text-center">
            <h1>Login</h1>
            <br>
            <?php
            
                if(isset($_SESSION["login"]))
                {
                    echo $_SESSION["login"];
                    unset($_SESSION["login"]);
                }

                if(isset($_SESSION["no-login"]))
                {
                    echo $_SESSION["no-login"];
                    unset($_SESSION["no-login"]);
                }
            ?>
            <br>
            <!--login form starts here-->
            <form action="" method="POST">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username">
                <br>
                <br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password">
                <br>
                <br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br>
                <br>

            </form>
            <!--login form ends here-->
            <p>Created By : <a href="#">Ajeeth</a></p>
        </div>
    </body>

</html>

<?php

    if(isset($_POST["submit"]))
    {
        $username=$_POST["username"];
        $password=md5($_POST["password"]);

        $sql="SELECT * FROM `table-admin` WHERE username='$username' AND password='$password'";

        $result=$conn->query($sql);
        if($result->num_rows==1)
        {
            $_SESSION["login"]="<div class='success'>Login Successful.. </div>";
            $_SESSION["user"]=$username;//to check whether user loggedin or not

            header("location:".$siteurl."admin/");
        }
        else
        {
            $_SESSION["login"]="<div class='error'>Login Failed.. </div>";
            header("location:".$siteurl."admin/login.php");
        }

    }

?>